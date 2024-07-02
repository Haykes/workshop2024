<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: "ventes")]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Peinture::class)]
    #[ORM\JoinColumn(name: "peinture_id", referencedColumnName: "id")]
    private ?Peinture $peinture = null;

    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(name: "client_id", referencedColumnName: "id")]
    private ?Client $client = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $realisedAt = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private ?float $amount = null;

    #[ORM\Column(type: "string", length: 20)]
    #[Assert\Choice(choices: ["en attente", "complétée", "annulée"], message: "Choisissez un statut valide.")]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

}
