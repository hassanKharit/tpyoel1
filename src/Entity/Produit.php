<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Commentaire::class)]
    private Collection $Produit;

    #[ORM\ManyToMany(targetEntity: Commentaire::class)]
    private Collection $user_id;

    public function __construct()
    {
        $this->Produit = new ArrayCollection();
        $this->user_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getProduit(): Collection
    {
        return $this->Produit;
    }

    public function addProduit(Commentaire $produit): self
    {
        if (!$this->Produit->contains($produit)) {
            $this->Produit->add($produit);
        }

        return $this;
    }

    public function removeProduit(Commentaire $produit): self
    {
        $this->Produit->removeElement($produit);

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(Commentaire $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
        }

        return $this;
    }

    public function removeUserId(Commentaire $userId): self
    {
        $this->user_id->removeElement($userId);

        return $this;
    }
}
