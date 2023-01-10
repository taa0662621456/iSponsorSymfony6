<?php

namespace App\Entity\Project;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Repository\Project\ProjectTagRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'project_tag')]
#[ORM\Index(columns: ['slug'], name: 'project_tag_idx')]
#[ORM\Entity(repositoryClass: ProjectTagRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource()]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class ProjectTag implements JsonSerializable
{
	use ObjectBaseTrait;
    use ObjectTitleTrait;

    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'projectTag')]
    private Collection $projectTagProject;

    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();
        $this->projectTagProject = new ArrayCollection();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;

    }
    # ManyToMany
    public function getProjectTagProject(): Collection
    {
        return $this->projectTagProject;
    }
    public function addProjectTag(Project $project): void
    {
        if (!$this->projectTagProject->contains($project)) {
            $this->projectTagProject[] = $project;
        }
    }
    public function removeProjectTag(ProjectTag $tag): self
    {
        if ($this->projectTagProject->contains($tag)) {
            $this->projectTagProject->removeElement($tag);
        }
        return $this;
    }
    #
    public function jsonSerialize(): string
    {
        // This entity implements JsonSerializable (http://php.net/manual/en/class.jsonserializable.php)
        // so this method is used to customize its JSON representation when json_encode()
        // is called, for example in tags|json_encode (app/Resources/views/form/fields.html.twig)
        return $this->firstTitle;
    }
    public function __toString(): string
    {
        return $this->firstTitle;
    }

}
