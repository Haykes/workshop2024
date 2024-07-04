<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks] // Ajouté pour les callbacks
#[ORM\Table(name: "peintures")]
#[Vich\Uploadable]
class Peinture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $number = null;

    #[ORM\Column(type: "text")]
    private ?string $description = null;

    #[ORM\Column(type: "integer")]
    private ?int $width = null;

    #[ORM\Column(type: "integer")]
    private ?int $height = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $method = null;  // Méthode de peinture

    #[ORM\Column(type: "integer")]
    private ?int $prize = null;

    #[ORM\Column(type: "integer")]
    private ?int $quantity = null;  // Changer à un entier

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: VenteStatus::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?VenteStatus $status = null;

    #[ORM\OneToMany(targetEntity: Certificat::class, mappedBy: "peinture")]
    private Collection $certificats;

    #[ORM\OneToMany(targetEntity: Gallery::class, mappedBy: "peinture", cascade: ["persist", "remove"])]
    private Collection $gallery;

    #[Vich\UploadableField(mapping: "peinture_image", fileNameProperty: "mainPhotoUrl")]
    private ?File $mainPhotoFile = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $mainPhotoUrl = null;

    public function __construct()
    {
        $this->certificats = new ArrayCollection();
        $this->gallery = new ArrayCollection();
    }

    // Getters and setters...

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): void
    {
        $this->width = $width;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): void
    {
        $this->height = $height;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(?string $method): void
    {
        $this->method = $method;
    }

    public function getPrize(): ?int
    {
        return $this->prize;
    }

    public function setPrize(?int $prize): void
    {
        $this->prize = $prize;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getStatus(): ?VenteStatus
    {
        return $this->status;
    }

    public function setStatus(?VenteStatus $status): void
    {
        $this->status = $status;
    }

    public function getGallery(): Collection
    {
        return $this->gallery;
    }

    public function addGallery(Gallery $gallery): self
    {
        if (!$this->gallery->contains($gallery)) {
            $this->gallery[] = $gallery;
            $gallery->setPeinture($this);
        }

        return $this;
    }

    public function removeGallery(Gallery $gallery): self
    {
        if ($this->gallery->removeElement($gallery)) {
            if ($gallery->getPeinture() === $this) {
                $gallery->setPeinture(null);
            }
        }

        return $this;
    }

    public function getMainPhotoFile(): ?File
    {
        return $this->mainPhotoFile;
    }

    public function setMainPhotoFile(?File $mainPhotoFile): void
    {
        $this->mainPhotoFile = $mainPhotoFile;

        if ($mainPhotoFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getMainPhotoUrl(): ?string
    {
        return $this->mainPhotoUrl;
    }

    public function setMainPhotoUrl(?string $mainPhotoUrl): void
    {
        $this->mainPhotoUrl = $mainPhotoUrl;
    }

    public function getCertificats(): Collection
    {
        return $this->certificats;
    }

    public function addCertificat(Certificat $certificat): self
    {
        if (!$this->certificats->contains($certificat)) {
            $this->certificats[] = $certificat;
            $certificat->setPeinture($this);
        }

        return $this;
    }

    public function removeCertificat(Certificat $certificat): self
    {
        if ($this->certificats->removeElement($certificat)) {
            // set the owning side to null (unless already changed)
            if ($certificat->getPeinture() === $this) {
                $certificat->setPeinture(null);
            }
        }

        return $this;
    }

    public function hasCertificat(): bool
    {
        return !$this->certificats->isEmpty();
    }

    public function __toString(): string
    {
        return $this->title ?: '';
    }
}
