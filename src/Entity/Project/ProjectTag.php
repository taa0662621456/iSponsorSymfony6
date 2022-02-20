<?php


namespace App\Entity\Project;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Table(name: 'projects_tags')]
#[ORM\Index(columns: ['slug'], name: 'project_tag_idx')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class ProjectTag implements JsonSerializable
{
	use BaseTrait;

	#[ORM\Column(type: 'string', unique: true)]
	private string $name;
	public function setName(string $name): void
	{
		$this->name = $name;
	}
	public function getName(): ?string
	{
		return $this->name;
	}
	/**
	 * {@inheritdoc}
	 */
	public function jsonSerialize(): string
	{
		// This entity implements JsonSerializable (http://php.net/manual/en/class.jsonserializable.php)
		// so this method is used to customize its JSON representation when json_encode()
		// is called, for example in tags|json_encode (app/Resources/views/form/fields.html.twig)
		return $this->name;
	}
	public function __toString(): string
	{
		return $this->name;
	}
}
