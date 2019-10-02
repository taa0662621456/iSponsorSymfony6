<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Project\ProjectsAttachments;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AttachmentsManager
{
	/**
	 * @var ContainerInterface
	 */
	private $container;
	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;

	public function __construct(ContainerInterface $container, EntityManagerInterface $entityManager)
	{
		$this->container = $container;
		$this->entityManager = $entityManager;
	}

	public function getUploadsDirectory()
	{
		return $this->container->getParameter('uploads');

	}

	/**
	 * @param              $entity
	 * @param UploadedFile $file
	 * @param              $fileTitle
	 * @param              $fileDescription
	 * @param              $fileMeta
	 * @param              $fileClass
	 * @param              $fileTemplatePosition
	 * @param              $filePath
	 * @param              $fileIsForSale
	 * @param              $fileLang
	 * @param              $published
	 * @param              $attachment
	 *
	 * @return array
	 */
	public function setAttachment($entity, UploadedFile $file, $fileTitle, $fileDescription, $fileMeta, $fileClass, $fileTemplatePosition, $filePath, $fileIsForSale, $fileLang, $published, $attachment)
	{
		$filename = md5(uniqid()) . '.' . $file->guessExtension();

		$file->move(
			$this->getUploadsDirectory(),
			$filename
		);
		$attachment->setFile($filename);
		$attachment->setFileTitle($fileTitle);
		$attachment->setFileDescription($fileDescription);
		$attachment->setFileMeta($fileMeta);
		$attachment->setMets($fileDescription);
		$attachment->setFileClass($fileClass);
		$attachment->setFileTemplatePosition($fileTemplatePosition);
		$attachment->setFilePath('/uploads/' . $filePath);
		$attachment->setFileMimeType('MimeType');
		$attachment->setFileIsForSale($fileIsForSale);
		$attachment->setFileLang($fileLang);
		$attachment->setPublished($published);

		$entity->setAttachment($attachment);

		$this->entityManager->persist($attachment);
		$this->entityManager->flush();


		return [
			'filename' => $filename,
			'path' => '/uploads/' . $filename
		];
	}


	/**
	 * @param         $entity
	 * @param         $createdBy
	 * @param         $published
	 * @param         $fileTemplatePosition
	 * @param         $fileClass
	 * @param         $fileLang
	 *
	 * @return array
	 */
	public function getAttachments($entity, $createdBy, $published, $fileTemplatePosition, $fileClass, $fileLang)
	{
		$repository = $this->entityManager->getRepository($entity);
		return $repository->findBy(array(
			'createdBy' => $createdBy,
			'published' => $published,
			'fileTemplatePosition' => $fileTemplatePosition,
			'fileClass' => $fileClass,
			'fileLang' => $fileLang,
		), array(
			'createdOn' => 'ASC'
		), 12, null);
	}

	public function removeAttachment(?string $filename)
	{
		if (!empty($filename)) {
			$filesystem = new Filesystem();
			$filesystem->remove($this->getUploadsDirectory() . $filename);
		}
	}
}
