<?php

namespace App\Entity;

use App\Repository\PozycjaFakturaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PozycjaFakturaRepository::class)
 */
class PozycjaFaktura
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float", length=255)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Faktura::class, inversedBy="pozycje")
     */
    private $faktura;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;
        if ($this->getFaktura()) {
            $this->getFaktura()->setValue();
        }

        return $this;
    }

    public function getFaktura(): ?Faktura
    {
        return $this->faktura;
    }

    public function setFaktura(?Faktura $faktura): self
    {
        $this->faktura = $faktura;

        return $this;
    }
}
