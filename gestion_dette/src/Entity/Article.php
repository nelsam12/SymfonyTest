<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le libellé de l\'article est obligatoire.')]
    #[Assert\Length(max: 255, maxMessage: 'Le libellé ne peut pas dépasser {{ limit }} caractères.')]
    private ?string $libelle = null;

    #[ORM\Column]
    #[Assert\Positive(message: 'La quantité en stock doit être un nombre positif.')]
    private ?int $qteStock = null;

    #[ORM\Column]
    #[Assert\Positive(message: 'Le prix unitaire doit être un nombre positif.')]
    private ?float $prixUnitaire = null;

    /**
     * @var Collection<int, ArticleDette>
     */
    #[ORM\OneToMany(targetEntity: ArticleDette::class, mappedBy: 'article')]
    private Collection $articleDettes;

    /**
     * @var Collection<int, ArticleDemande>
     */
    #[ORM\OneToMany(targetEntity: ArticleDemande::class, mappedBy: 'article')]
    private Collection $articleDemandes;

    #[ORM\Column]
    private ?bool $isAvailable = null;

    public function __construct()
    {
        $this->articleDettes = new ArrayCollection();
        $this->articleDemandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getQteStock(): ?int
    {
        return $this->qteStock;
    }

    public function setQteStock(int $qteStock): static
    {
        $this->qteStock = $qteStock;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): static
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    /**
     * @return Collection<int, ArticleDette>
     */
    public function getArticleDettes(): Collection
    {
        return $this->articleDettes;
    }

    public function addArticleDette(ArticleDette $articleDette): static
    {
        if (!$this->articleDettes->contains($articleDette)) {
            $this->articleDettes->add($articleDette);
            $articleDette->setArticle($this);
        }

        return $this;
    }

    public function removeArticleDette(ArticleDette $articleDette): static
    {
        if ($this->articleDettes->removeElement($articleDette)) {
            // set the owning side to null (unless already changed)
            if ($articleDette->getArticle() === $this) {
                $articleDette->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArticleDemande>
     */
    public function getArticleDemandes(): Collection
    {
        return $this->articleDemandes;
    }

    public function addArticleDemande(ArticleDemande $articleDemande): static
    {
        if (!$this->articleDemandes->contains($articleDemande)) {
            $this->articleDemandes->add($articleDemande);
            $articleDemande->setArticle($this);
        }

        return $this;
    }

    public function removeArticleDemande(ArticleDemande $articleDemande): static
    {
        if ($this->articleDemandes->removeElement($articleDemande)) {
            // set the owning side to null (unless already changed)
            if ($articleDemande->getArticle() === $this) {
                $articleDemande->setArticle(null);
            }
        }

        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setAvailable(bool $isAvailable): static
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }
}
