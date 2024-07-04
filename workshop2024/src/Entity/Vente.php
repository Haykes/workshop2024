<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: "ventes")]
#[ORM\HasLifecycleCallbacks]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Peinture::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Peinture $peinture = null;

    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\ManyToOne(targetEntity: VenteStatus::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?VenteStatus $status = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $realisedAt = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private ?float $amount = null;

    #[ORM\PrePersist]
    public function prePersist()
    {
        if ($this->peinture) {
            $this->amount = $this->peinture->getPrize();
        }
    }

    #[ORM\PreUpdate]
    public function preUpdate()
    {
        if ($this->peinture) {
            $this->amount = $this->peinture->getPrize();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeinture(): ?Peinture
    {
        return $this->peinture;
    }

    public function setPeinture(?Peinture $peinture): void
    {
        $this->peinture = $peinture;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): void
    {
        $this->client = $client;
    }

    public function getStatus(): ?VenteStatus
    {
        return $this->status;
    }

    public function setStatus(?VenteStatus $status): void
    {
        $this->status = $status;
    }

    public function getRealisedAt(): ?\DateTimeInterface
    {
        return $this->realisedAt;
    }

    public function setRealisedAt(?\DateTimeInterface $realisedAt): void
    {
        $this->realisedAt = $realisedAt;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }
}
