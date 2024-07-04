<?php

namespace App\Entity;

use App\Repository\CertificatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CertificatRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Certificat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Peinture::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Peinture $peinture = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $generatedAt = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $filePath = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeinture(): ?Peinture
    {
        return $this->peinture;
    }

    public function setPeinture(?Peinture $peinture): self
    {
        $this->peinture = $peinture;

        return $this;
    }

    public function getGeneratedAt(): ?\DateTimeInterface
    {
        return $this->generatedAt;
    }

    #[ORM\PrePersist]
    public function setGeneratedAtValue(): void
    {
        $this->generatedAt = new \DateTime();
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }
}
