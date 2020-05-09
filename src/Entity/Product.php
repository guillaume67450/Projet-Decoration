<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Artgris\Bundle\MediaBundle\Form\Validator\Constraint as MediaAssert; // optionnal, to force image files

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Vich\Uploadable
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Brand;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $URLaffiliation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="Products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    // NOTE https://github.com/artgris/mediaBundle

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $Image;

    /**
     * @var Collection|string[]
     * @ORM\Column(type="simple_array", nullable=true)
     * @MediaAssert\Image()
     */
    private $Gallery;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Price;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $ReducedPrice;

    public function __construct()
    {
        $this->updatedAt = new \DateTime('now');
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->Brand;
    }

    public function setBrand(string $Brand): self
    {
        $this->Brand = $Brand;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getURLaffiliation(): ?string
    {
        return $this->URLaffiliation;
    }

    public function setURLaffiliation(?string $URLaffiliation): self
    {
        $this->URLaffiliation = $URLaffiliation;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }



    /**
     * Get the value of Gallery
     *
     * @return  Collection|string[]
     */ 
    public function getGallery()
    {
        return $this->Gallery;
    }

    /**
     * Set the value of Gallery
     *
     * @param  Collection|string[]  $Gallery
     *
     * @return  self
     */ 
    public function setGallery($Gallery)
    {
        $this->Gallery = $Gallery;

        return $this;
    }

    /**
     * Get the value of Image
     *
     * @return  string
     */ 
    public function getImage()
    {
        return $this->Image;
    }

    /**
     * Set the value of Image
     *
     * @param  string  $Image
     *
     * @return  self
     */ 
    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(?float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getReducedPrice(): ?float
    {
        return $this->ReducedPrice;
    }

    public function setReducedPrice(?float $ReducedPrice): self
    {
        $this->ReducedPrice = $ReducedPrice;

        return $this;
    }

}
