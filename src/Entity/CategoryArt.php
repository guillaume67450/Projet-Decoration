<?php

namespace App\Entity;

use App\Repository\CategoryArtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryArtRepository::class)
 */
class CategoryArt
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, inversedBy="categoryArt")
     */
    private $categories_articles;

    public function __construct()
    {
        $this->categories_articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getCategoriesArticles(): Collection
    {
        return $this->categories_articles;
    }

    public function addCategoriesArticle(Article $categoriesArticle): self
    {
        if (!$this->categories_articles->contains($categoriesArticle)) {
            $this->categories_articles[] = $categoriesArticle;
        }

        return $this;
    }

    public function removeCategoriesArticle(Article $categoriesArticle): self
    {
        if ($this->categories_articles->contains($categoriesArticle)) {
            $this->categories_articles->removeElement($categoriesArticle);
        }

        return $this;
    }
}
