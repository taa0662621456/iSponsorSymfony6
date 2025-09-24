<?php

namespace App\Service;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

final class TableRenderer
{
    private Table $table;

    private ?array $headers = null;

    private array $rows = [];

    private ?string $label = null;

    public function __construct(private readonly OutputInterface $output)
    {
        $this->table = new Table($output);
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function addRow(array $row): void
    {
        $this->rows[] = $row;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function render(): void
    {
        if (null !== $this->label) {
            $this->output->writeln(sprintf('<comment>%s</comment>', $this->label));
        }

        $this->table
            ->setHeaders($this->headers)
            ->setRows($this->rows)
            ->render()
        ;
    }

    public function isEmpty(): bool
    {
        return empty($this->rows);
    }
}