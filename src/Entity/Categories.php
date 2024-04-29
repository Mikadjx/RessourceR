<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cat_etiquette = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $cat_dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $car_dateMaj = null;

    #[ORM\ManyToMany(targetEntity: Ressources::class, inversedBy: 'categories')]
    private Collection $ressources;

    public function __construct()
    {
        $this->ressources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatEtiquette(): ?string
    {
        return $this->cat_etiquette;
    }

    public function setCatEtiquette(string $cat_etiquette): static
    {
        $this->cat_etiquette = $cat_etiquette;

        return $this;
    }

    public function getCatDateCreation(): ?\DateTimeInterface
    {
        return $this->cat_dateCreation;
    }

    public function setCatDateCreation(\DateTimeInterface $cat_dateCreation): static
    {
        $this->cat_dateCreation = $cat_dateCreation;

        return $this;
    }

    public function getCarDateMaj(): ?\DateTimeInterface
    {
        return $this->car_dateMaj;
    }

    public function setCarDateMaj(?\DateTimeInterface $car_dateMaj): static
    {
        $this->car_dateMaj = $car_dateMaj;

        return $this;
    }

    /**
     * @return Collection<int, Ressources>
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressources $ressource): static
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources->add($ressource);
        }

        return $this;
    }

    public function removeRessource(Ressources $ressource): static
    {
        $this->ressources->removeElement($ressource);

        return $this;
    }
}
