<?php

namespace App\Entity;

use App\Repository\ArticleDemandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleDemandeRepository::class)]
class ArticleDemande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $qte = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\ManyToOne(inversedBy: 'articleDemandes')]
    private ?Article $article = null;

    #[ORM\ManyToOne(inversedBy: 'articleDemandes')]
    private ?DemandeDette $demandeDette = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): static
    {
        $this->qte = $qte;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

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

    public function getDemandeDette(): ?DemandeDette
    {
        return $this->demandeDette;
    }

    public function setDemandeDette(?DemandeDette $demandeDette): static
    {
        $this->demandeDette = $demandeDette;

        return $this;
    }
}
