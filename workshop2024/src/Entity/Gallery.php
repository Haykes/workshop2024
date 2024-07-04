<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity]
#[ORM\Table(name: "gallery")]
#[Vich\Uploadable]
class Gallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $url = null;

    #[Vich\UploadableField(mapping: "gallery_image", fileNameProperty: "url")]
    private ?File $imageFile = null;

    #[ORM\ManyToOne(targetEntity: Peinture::class, inversedBy: "gallery")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Peinture $peinture = null;

    #[ORM\Column(type: "boolean")]
    private bool $isMain = false;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getPeinture(): ?Peinture
    {
        return $this->peinture;
    }

    public function setPeinture(?Peinture $peinture): void
    {
        $this->peinture = $peinture;
    }

    public function isMain(): bool
    {
        return $this->isMain;
    }

    public function setMain(bool $isMain): void
    {
        $this->isMain = $isMain;
    }
}
