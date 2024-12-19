<?php

namespace App\Entity;

use App\Repository\ArticleDetteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleDetteRepository::class)]
class ArticleDette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $qteAchete = null;

    #[ORM\ManyToOne(inversedBy: 'articleDettes')]
    private ?Dette $dette = null;

    #[ORM\ManyToOne(inversedBy: 'articleDettes')]
    private ?Article $article = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteAchete(): ?int
    {
        return $this->qteAchete;
    }

    public function setQteAchete(int $qteAchete): static
    {
        $this->qteAchete = $qteAchete;

        return $this;
    }

    public function getDette(): ?Dette
    {
        return $this->dette;
    }

    public function setDette(?Dette $dette): static
    {
        $this->dette = $dette;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }
}
