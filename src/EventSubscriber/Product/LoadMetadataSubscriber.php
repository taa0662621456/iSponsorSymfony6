<?php

namespace App\EventSubscriber\Product;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Mapping\ClassMetadataFactory;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\Persistence\Mapping\MappingException;

final class LoadMetadataSubscriber implements EventSubscriber
{
    public function __construct(private readonly array $subjects)
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            'loadClassMetadata',
        ];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs): void
    {
        $metadata = $eventArgs->getClassMetadata();
        $metadataFactory = $eventArgs->getEntityManager()->getMetadataFactory();

        foreach ($this->subjects as $subject => $class) {
            if ($class['attribute_value']['classes']['model'] === $metadata->getName()) {
                $this->mapSubjectOnAttributeValue($subject, $class['subject'], $metadata, $metadataFactory);
                $this->mapAttributeOnAttributeValue($class['attribute']['classes']['model'], $metadata, $metadataFactory);
            }
        }
    }

    private function mapSubjectOnAttributeValue(
        string $subject,
        string $subjectClass,
        ClassMetadataInfo $metadata,
        ClassMetadataFactory $metadataFactory,
    ): void {
        /** @var ClassMetadataInfo $targetEntityMetadata */
        try {
            $targetEntityMetadata = $metadataFactory->getMetadataFor($subjectClass);
        } catch (MappingException|\ReflectionException $e) {
        }
        $subjectMapping = [
            'fieldName' => 'subject',
            'targetEntity' => $subjectClass,
            'inversedBy' => 'attributes',
            'joinColumns' => [[
                'name' => $subject.'_id',
                'referencedColumnName' => $targetEntityMetadata->fieldMappings['id']['columnName'] ?? $targetEntityMetadata->fieldMappings['id']['fieldName'],
                'nullable' => false,
                'onDelete' => 'CASCADE',
            ]],
        ];

        $this->mapManyToOne($metadata, $subjectMapping);
    }

    private function mapAttributeOnAttributeValue(
        string $attributeClass,
        ClassMetadataInfo $metadata,
        ClassMetadataFactory $metadataFactory,
    ): void {
        /** @var ClassMetadataInfo $attributeMetadata */
        try {
            $attributeMetadata = $metadataFactory->getMetadataFor($attributeClass);
        } catch (MappingException|\ReflectionException $e) {
        }
        $attributeMapping = [
            'fieldName' => 'attribute',
            'targetEntity' => $attributeClass,
            'joinColumns' => [[
                'name' => 'attribute_id',
                'referencedColumnName' => $attributeMetadata->fieldMappings['id']['columnName'] ?? $attributeMetadata->fieldMappings['id']['fieldName'],
                'nullable' => false,
            ]],
        ];

        $this->mapManyToOne($metadata, $attributeMapping);
    }

    private function mapManyToOne(ClassMetadataInfo $metadata, array $subjectMapping): void
    {
        $metadata->mapManyToOne($subjectMapping);
    }
}
