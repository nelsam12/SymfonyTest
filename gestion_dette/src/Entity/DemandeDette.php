<?php

namespace App\Entity;

use App\Repository\DemandeDetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeDetteRepository::class)]
class DemandeDette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column]
    private ?float $montantVerse = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $updateAt = null;

    /**
     * @var Collection<int, ArticleDemande>
     */
    #[ORM\OneToMany(targetEntity: ArticleDemande::class, mappedBy: 'demandeDette')]
    private Collection $articleDemandes;

    public function __construct()
    {
        $this->articleDemandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

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

    public function getMontantVerse(): ?float
    {
        return $this->montantVerse;
    }

    public function setMontantVerse(float $montantVerse): static
    {
        $this->montantVerse = $montantVerse;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): static
    {
        $this->updateAt = $updateAt;

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
            $articleDemande->setDemandeDette($this);
        }

        return $this;
    }

    public function removeArticleDemande(ArticleDemande $articleDemande): static
    {
        if ($this->articleDemandes->removeElement($articleDemande)) {
            // set the owning side to null (unless already changed)
            if ($articleDemande->getDemandeDette() === $this) {
                $articleDemande->setDemandeDette(null);
            }
        }

        return $this;
    }
}
