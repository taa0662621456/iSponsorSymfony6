<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JetBrains\PhpStorm\Pure;

trait ProductLanguageTrait
{

    #[ORM\Column(name: 'product_name', type: 'string', nullable: false, options: ['default' => ''])]
    #[Assert\NotBlank(message: 'product.name.blank')]
    #[Assert\NotNull(message: 'product.name.null')]
    #[Assert\Length(min: 56, minMessage: 'product.name.too.short')]
    #[Assert\Length(max: 255, maxMessage: 'product.name.too.long.')]
    private string $productName = 'product_name';


    #[ORM\Column(name: 'product_s_desc', type: 'text', nullable: false, options: ['default' => 'product_s_desc'])]
    #[Assert\NotBlank(message: 'product.s.description.blank')]
    #[Assert\NotNull(message: 'product.s.description.null')]
    #[Assert\Length(min: 56, minMessage: 'product.s.description.too.short')]
    #[Assert\Length(max: 15000, maxMessage: 'product.s.description.too.long.')]
    private string $productSDesc = 'product_s_desc';


    #[ORM\Column(name: 'product_desc', type: 'text', nullable: false, options: ['default' => 'product_desc'])]
    #[Assert\NotBlank(message: 'product.description.blank')]
    #[Assert\NotNull(message: 'product.description.null')]
    #[Assert\Length(min: 56, minMessage: 'product.description.too.short')]
    #[Assert\Length(max: 15000, maxMessage: 'product.description.too.long.')]
    private string $productDesc = 'product_desc';

//    /**
//     * @return string
//     */
//    #[Pure]
//    public function __toString() {
//        return $this->getProductName();
//    }

    public function getProductSDesc(): string
    {
        return $this->productSDesc;
    }

    public function setProductSDesc(string $productSDesc): void
    {
        $this->productSDesc = $productSDesc;
    }

    public function getProductDesc(): string
    {
        return $this->productDesc;
    }

    public function setProductDesc(string $productDesc): void
    {
        $this->productDesc = $productDesc;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

}
