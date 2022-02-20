<?php


namespace App\Entity\Featured;

use App\Entity\BaseTrait;
use App\Entity\Category\Category;
use App\Entity\Product\Product;
use App\Entity\Project\Project;
use App\Entity\Vendor\Vendor;
use App\Repository\Featured\FeaturedRepository;
use Doctrine\ORM\Mapping as ORM;


 #[ORM\Table(name: 'features')]
#[ORM\Entity(repositoryClass: FeaturedRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Featured
{
	use BaseTrait;

	#[ORM\Column(name: 'ordering', type: 'integer')]
	private int $ordering;

	#[ORM\Column(name: 'featured_type', type: 'string')]
	private string $featuredType;
	#[ORM\OneToOne(inversedBy: 'projectFeatured', targetEntity: Project::class)]
	#[ORM\JoinColumn(name: 'projectFeatured_id', referencedColumnName: 'id', nullable: true)]
	private Project $projectFeatured;
	#[ORM\OneToOne(inversedBy: 'productFeatured', targetEntity: Product::class)]
	#[ORM\JoinColumn(name: 'productFeatured_id', referencedColumnName: 'id', nullable: true)]
	private Product $productFeatured;
	#[ORM\OneToOne(inversedBy: 'categoryFeatured', targetEntity: Category::class)]
	#[ORM\JoinColumn(name: 'categoryFeatured_id', referencedColumnName: 'id', nullable: true)]
	private Category $categoryFeatured;
	#[ORM\OneToOne(inversedBy: 'vendorFeatured', targetEntity: Vendor::class)]
	#[ORM\JoinColumn(name: 'vendorFeatured_id', referencedColumnName: 'id', nullable: true)]
	private Vendor $vendorFeatured;

     /**
      * @param $ordering
      * @return Featured
      */
	public function setOrdering($ordering): static
 {
     $this->ordering = $ordering;
     return $this;
 }
	public function getOrdering(): int
 {
     return $this->ordering;
 }
	public function getFeaturedType(): string
 {
     return $this->featuredType;
 }
	public function setFeaturedType(string $featuredType): void
 {
     $this->featuredType = $featuredType;
 }
}
