<?php
namespace App\Factory;

use Doctrine\ORM\EntityManagerInterface;

class EntityFactory
{
private string $object = 'App\\Entity\\Object';
private EntityManagerInterface $entityManager;

public function __construct(EntityManagerInterface $entityManager, string $object)
{
    $this->object = 'App\\Entity\\' . $object;
    $this->entityManager = $entityManager;
    }

    /**
    * Создание объекта с учётом локали.
    */
    public static function createObjectLanguageLayer(string $localFilterReq = null, $object = null): object
    {
    // Если локаль не указана, используем дефолтную
    $localFilterReq = $localFilterReq ?: 'en'; // Например, 'en' по умолчанию

    // Генерируем имя класса с суффиксом локали
    $className = '\\App\\Entity\\' . $object . '\\' . $object . '_' . $localFilterReq;

    // Проверяем, существует ли такой класс
    if (!class_exists($className)) {
    throw new \RuntimeException("Class $className does not exist.");
    }

    // Возвращаем новый экземпляр сущности
    return new $className();
    }

    /**
    * Создание сущности с учётом локали и динамическим выбором таблицы.
    */
    public function createWithLocale($objectName, string $locale): object
    {
    // Создаём объект с локалью
    $object = $this->createObjectLanguageLayer($locale, $objectName);

    // Получаем метаданные сущности
    $metadata = $this->entityManager->getClassMetadata(get_class($object));

    // Устанавливаем имя таблицы в зависимости от локали
    $metadata->setTableName($metadata->getTableName() . "_" . $locale);

    // Возвращаем объект с изменённой таблицей
    return $object;
    }
}
