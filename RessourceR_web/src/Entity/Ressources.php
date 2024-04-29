<?php

namespace App\Entity;

use App\Repository\RessourcesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RessourcesRepository::class)]
#[Vich\Uploadable]
class Ressources
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $res_titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $res_content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $res_dateCreation = null;

    #[ORM\Column(nullable: true)]
    private ?bool $res_estExploitee = null;

    #[ORM\Column(nullable: true)]
    private ?bool $res_estRestrictif = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $res_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $res_path = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $res_etiquette = null;

    
    #[Vich\UploadableField(mapping: 'ressources', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'com_ressources', targetEntity: Commentaires::class)]
    private Collection $commentaires;

    #[ORM\ManyToMany(targetEntity: Categories::class, mappedBy: 'ressources')]
    private Collection $categories;

    #[ORM\ManyToMany(targetEntity: Tags::class, mappedBy: 'ressources')]
    private Collection $tags;

    #[ORM\OneToMany(mappedBy: 'ressources', targetEntity: Favoris::class)]
    private Collection $favoris;

    #[ORM\ManyToOne(inversedBy: 'ressources')]
    private ?Utilisateurs $utilisateurs = null;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->favoris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResTitre(): ?string
    {
        return $this->res_titre;
    }

    public function setResTitre(string $res_titre): static
    {
        $this->res_titre = $res_titre;

        return $this;
    }

    public function getResContent(): ?string
    {
        return $this->res_content;
    }

    public function setResContent(string $res_content): static
    {
        $this->res_content = $res_content;

        return $this;
    }

    public function getResDateCreation(): ?\DateTimeInterface
    {
        return $this->res_dateCreation;
    }

    public function setResDateCreation(\DateTimeInterface $res_dateCreation): static
    {
        $this->res_dateCreation = $res_dateCreation;

        return $this;
    }

    public function isResEstExploitee(): ?bool
    {
        return $this->res_estExploitee;
    }

    public function setResEstExploitee(?bool $res_estExploitee): static
    {
        $this->res_estExploitee = $res_estExploitee;

        return $this;
    }

    public function isResEstRestrictif(): ?bool
    {
        return $this->res_estRestrictif;
    }

    public function setResEstRestrictif(?bool $res_estRestrictif): static
    {
        $this->res_estRestrictif = $res_estRestrictif;

        return $this;
    }

    public function getResType(): ?string
    {
        return $this->res_type;
    }

    public function setResType(?string $res_type): static
    {
        $this->res_type = $res_type;

        return $this;
    }

    public function getResPath(): ?string
    {
        return $this->res_path;
    }

    public function setResPath(?string $res_path): static
    {
        $this->res_path = $res_path;

        return $this;
    }

    public function getResEtiquette(): ?string
    {
        return $this->res_etiquette;
    }

    public function setResEtiquette(?string $res_etiquette): static
    {
        $this->res_etiquette = $res_etiquette;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
          
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }


    /**
     * @return Collection<int, Commentaires>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setComRessources($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getComRessources() === $this) {
                $commentaire->setComRessources(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addRessource($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeRessource($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Tags>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addRessource($this);
        }

        return $this;
    }

    public function removeTag(Tags $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeRessource($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Favoris>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): static
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
            $favori->setRessources($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): static
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getRessources() === $this) {
                $favori->setRessources(null);
            }
        }

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
