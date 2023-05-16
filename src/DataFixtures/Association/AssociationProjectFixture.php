<?php


namespace App\DataFixtures\Association;

use App\DataFixtures\AbstractDataFixture;
use App\Entity\Association\AssociationProject;
use App\Repository\Association\AssociationProjectTypeRepository;
use App\Repository\Project\ProjectRepository;


final class AssociationProjectFixture extends AbstractDataFixture
{
    private ProjectRepository $projectRepository;
    private AssociationProjectTypeRepository $associationTypeProjectRepository;

    public function __construct(
        ProjectRepository $projectRepository,
        AssociationProjectTypeRepository $associationTypeProjectRepository
    ) {
        parent::__construct();
        $this->projectRepository = $projectRepository;
        $this->associationTypeProjectRepository = $associationTypeProjectRepository;
    }

    public function getName(): string
    {
        return 'association_project';
    }

    public function load($manager): void
    {
        parent::load($manager);

        // Получаем все продукты
        $projects = $this->projectRepository->findAll();

        // Получаем все типы ассоциаций
        $associationTypes = $this->associationTypeProjectRepository->findAll();

        // Создаем ассоциации продуктов
        foreach ($projects as $project) {
            foreach ($associationTypes as $associationType) {
                // Создаем новую ассоциацию продукта
                $associationProject = new AssociationProject();
                $associationProject->setProject($project);
                $associationProject->setAssociationType($associationType);

                // Сохраняем ассоциацию продукта
                $manager->persist($associationProject);
            }
        }

        // Сохраняем изменения в базе данных
        $manager->flush();
        $manager->clear();
    }
}
