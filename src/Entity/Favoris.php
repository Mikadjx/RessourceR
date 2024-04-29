<?php

namespace App\Entity;

use App\Repository\FavorisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavorisRepository::class)]
class Favoris
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fav_dateCreation = null;

    #[ORM\Column(length: 255)]
    private ?string $fav_titre = null;

    #[ORM\ManyToOne(inversedBy: 'favoris')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ressources $ressources = null;

    #[ORM\ManyToOne(inversedBy: 'favoris')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateurs $utilisateurs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFavDateCreation(): ?\DateTimeInterface
    {
        return $this->fav_dateCreation;
    }

    public function setFavDateCreation(\DateTimeInterface $fav_dateCreation): static
    {
        $this->fav_dateCreation = $fav_dateCreation;

        return $this;
    }

    public function getFavTitre(): ?string
    {
        return $this->fav_titre;
    }

    public function setFavTitre(string $fav_titre): static
    {
        $this->fav_titre = $fav_titre;

        return $this;
    }

    public function getRessources(): ?Ressources
    {
        return $this->ressources;
    }

    public function setRessources(?Ressources $ressources): static
    {
        $this->ressources = $ressources;

        return $this;
    }

    public function getUtilisateurs(): ?Utilisateurs
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(?Utilisateurs $utilisateurs): static
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }
}
