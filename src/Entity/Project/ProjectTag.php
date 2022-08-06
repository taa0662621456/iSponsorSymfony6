<?php

namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Project\ProjectTagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Table(name: 'project_tag')]
#[ORM\Index(columns: ['slug'], name: 'project_tag_idx')]
#[ORM\Entity(repositoryClass: ProjectTagRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProjectTag implements JsonSerializable
{
	use BaseTrait;
    use ObjectTrait;

    #[ORM\OneToMany(mappedBy: 'projectTag', targetEntity: Project::class)]
    private Collection $projectTagProject;

    public function __construct()
    {
        $this->projectTagProject = new ArrayCollection();
    }
    # OneToMany
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
