<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentairesRepository::class)]
class Commentaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $com_content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $com_datePublication = null;

    #[ORM\Column]
    private ?bool $com_statutValidation = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ressources $com_ressources = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    private ?Utilisateurs $utilisateurs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComContent(): ?string
    {
        return $this->com_content;
    }

    public function setComContent(string $com_content): static
    {
        $this->com_content = $com_content;

        return $this;
    }

    public function getComDatePublication(): ?\DateTimeInterface
    {
        return $this->com_datePublication;
    }

    public function setComDatePublication(\DateTimeInterface $com_datePublication): static
    {
        $this->com_datePublication = $com_datePublication;

        return $this;
    }

    public function isComStatutValidation(): ?bool
    {
        return $this->com_statutValidation;
    }

    public function setComStatutValidation(bool $com_statutValidation): static
    {
        $this->com_statutValidation = $com_statutValidation;

        return $this;
    }

    public function getComRessources(): ?Ressources
    {
        return $this->com_ressources;
    }

    public function setComRessources(?Ressources $com_ressources): static
    {
        $this->com_ressources = $com_ressources;

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
