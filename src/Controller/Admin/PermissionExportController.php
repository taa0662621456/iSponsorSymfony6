<?php

namespace App\Controller\Admin;

use App\Entity\Security\PermissionChangeLog;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermissionExportController extends AbstractController
{
    #[Route('/admin/export-permissions-xlsx', name: 'admin_export_permissions_xlsx')]
    public function export(EntityManagerInterface $em): Response
    {
        $logs = $em->getRepository(PermissionChangeLog::class)->findBy([], ['changedAt' => 'DESC']);

        $groupedLogs = [];
        $summary = [];
        $total = ['grant' => 0, 'revoke' => 0];

        foreach ($logs as $log) {
            $role = $log->getRole();
            $groupedLogs[$role][] = $log;

            if (!isset($summary[$role])) {
                $summary[$role] = ['grant' => 0, 'revoke' => 0];
            }
            $summary[$role][$log->getAction()]++;
            $total[$log->getAction()]++;
        }

        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0);

        $headers = ['ID', 'Role', 'Permission', 'Action', 'Changed By', 'Changed At'];

        // === Summary лист ===
        $summarySheet = $spreadsheet->createSheet(0);
        $summarySheet->setTitle('Summary');

        $summarySheet->setCellValue('A1', 'Role');
        $summarySheet->setCellValue('B1', 'Granted');
        $summarySheet->setCellValue('C1', 'Revoked');

        $summarySheet->getStyle('A1:C1')->getFont()->setBold(true);
        $summarySheet->getStyle('A1:C1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFD9D9D9');

        $row = 2;
        foreach ($summary as $role => $counts) {
            $summarySheet->setCellValue("A$row", $role);
            $summarySheet->setCellValue("B$row", $counts['grant']);
            $summarySheet->setCellValue("C$row", $counts['revoke']);

            $summarySheet->getStyle("B$row")->getFont()->getColor()->setARGB(Color::COLOR_GREEN);
            $summarySheet->getStyle("C$row")->getFont()->getColor()->setARGB(Color::COLOR_RED);
            $row++;
        }

        // === Общие итоги ===
        $summarySheet->setCellValue("A$row", 'TOTAL');
        $summarySheet->setCellValue("B$row", $total['grant']);
        $summarySheet->setCellValue("C$row", $total['revoke']);
        $summarySheet->getStyle("A$row:C$row")->getFont()->setBold(true);
        $summarySheet->getStyle("B$row")->getFont()->getColor()->setARGB(Color::COLOR_GREEN);
        $summarySheet->getStyle("C$row")->getFont()->getColor()->setARGB(Color::COLOR_RED);

        foreach (['A','B','C'] as $col) {
            $summarySheet->getColumnDimension($col)->setAutoSize(true);
        }

        // === Столбчатая диаграмма по ролям ===
        $lastDataRow = $row - 1; // до TOTAL
        $dataSeriesLabels = [
            new DataSeriesValues('String', 'Summary!$B$1', null, 1),
            new DataSeriesValues('String', 'Summary!$C$1', null, 1),
        ];
        $xAxisTickValues = [
            new DataSeriesValues('String', "Summary!$A$2:$A$$lastDataRow", null, ($lastDataRow - 1)),
        ];
        $dataSeriesValues = [
            new DataSeriesValues('Number', "Summary!$B$2:$B$$lastDataRow", null, ($lastDataRow - 1)),
            new DataSeriesValues('Number', "Summary!$C$2:$C$$lastDataRow", null, ($lastDataRow - 1)),
        ];

        $series = new DataSeries(
            DataSeries::TYPE_BARCHART,
            DataSeries::GROUPING_CLUSTERED,
            range(0, count($dataSeriesValues) - 1),
            $dataSeriesLabels,
            $xAxisTickValues,
            $dataSeriesValues
        );
        $series->setPlotDirection(DataSeries::DIRECTION_COL);

        $plotArea = new PlotArea(null, [$series]);
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        $title = new Title('Permissions by Role');

        $barChart = new Chart('permission_chart', $title, $legend, $plotArea);
        $barChart->setTopLeftPosition('E2');
        $barChart->setBottomRightPosition('M20');
        $summarySheet->addChart($barChart);

        // === Круговая диаграмма для TOTAL ===
        $pieLabels = [
            new DataSeriesValues('String', "Summary!$B$1", null, 1),
            new DataSeriesValues('String', "Summary!$C$1", null, 1),
        ];
        $pieValues = [
            new DataSeriesValues('Number', "Summary!$B$row:C$row", null, 2),
        ];

        $pieSeries = new DataSeries(
            DataSeries::TYPE_PIECHART,
            null,
            range(0, count($pieValues) - 1),
            $pieLabels,
            [],
            $pieValues
        );

        $piePlot = new PlotArea(null, [$pieSeries]);
        $pieLegend = new Legend(Legend::POSITION_RIGHT, null, false);
        $pieTitle = new Title('Total Grants vs Revokes');

        $pieChart = new Chart('total_pie', $pieTitle, $pieLegend, $piePlot);
        $pieChart->setTopLeftPosition('E22');
        $pieChart->setBottomRightPosition('M40');

        $summarySheet->addChart($pieChart);

        // === отдельные листы по ролям (как было) ===
        foreach ($groupedLogs as $role => $roleLogs) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle(substr($role, 0, 30));

            $col = 1;
            foreach ($headers as $header) {
                $cell = $sheet->getCellByColumnAndRow($col, 1);
                $cell->setValue($header);
                $sheet->getStyleByColumnAndRow($col, 1)->getFont()->setBold(true);
                $sheet->getStyleByColumnAndRow($col, 1)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFD9D9D9');
                $col++;
            }

            $row = 2;
            foreach ($roleLogs as $log) {
                $sheet->setCellValueByColumnAndRow(1, $row, $log->getId());
                $sheet->setCellValueByColumnAndRow(2, $row, $log->getRole());
                $sheet->setCellValueByColumnAndRow(3, $row, $log->getPermission());

                $actionCell = $sheet->getCellByColumnAndRow(4, $row);
                $actionCell->setValue(ucfirst($log->getAction()));

                $style = $sheet->getStyleByColumnAndRow(4, $row)->getFont();
                if ($log->getAction() === 'grant') {
                    $style->getColor()->setARGB(Color::COLOR_GREEN);
                } elseif ($log->getAction() === 'revoke') {
                    $style->getColor()->setARGB(Color::COLOR_RED);
                }

                $sheet->setCellValueByColumnAndRow(5, $row, $log->getChangedBy());
                $sheet->setCellValueByColumnAndRow(6, $row, $log->getChangedAt()->format('Y-m-d H:i:s'));
                $row++;
            }

            foreach (range(1, count($headers)) as $col) {
                $sheet->getColumnDimensionByColumn($col)->setAutoSize(true);
            }
        }

        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true);

        $fileName = 'permission_logs_' . date('Ymd_His') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        return $this->file($tempFile, $fileName, Response::HTTP_OK, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]);
    }
}
