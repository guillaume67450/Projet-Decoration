<?php

namespace App\Entity;

use App\Repository\KeywordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KeywordRepository::class)
 */
class Keyword
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
    private $keyword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, inversedBy="keywords")
     */
    private $keywords_articles;

    public function __construct()
    {
        $this->keywords_articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(string $keyword): self
    {
        $this->keyword = $keyword;

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
    public function getKeywordsArticles(): Collection
    {
        return $this->keywords_articles;
    }

    public function addKeywordsArticle(Article $keywordsArticle): self
    {
        if (!$this->keywords_articles->contains($keywordsArticle)) {
            $this->keywords_articles[] = $keywordsArticle;
        }

        return $this;
    }

    public function removeKeywordsArticle(Article $keywordsArticle): self
    {
        if ($this->keywords_articles->contains($keywordsArticle)) {
            $this->keywords_articles->removeElement($keywordsArticle);
        }

        return $this;
    }
}
