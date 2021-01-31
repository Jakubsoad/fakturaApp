<?php

namespace App\Entity;

use App\Repository\FakturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FakturaRepository::class)
 */
class Faktura
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="fakturyNabywca")
     */
    private $nabywca;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="fakturaOdbiorca")
     */
    private $odbiorca;

    /**
     * @ORM\OneToMany(targetEntity=PozycjaFaktura::class, mappedBy="faktura")
     */
    private $pozycje;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $value;

    public function __construct()
    {
        $this->pozycje = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNabywca(): ?Person
    {
        return $this->nabywca;
    }

    public function setNabywca(?Person $nabywca): self
    {
        $this->nabywca = $nabywca;

        return $this;
    }

    public function getOdbiorca(): ?Person
    {
        return $this->odbiorca;
    }

    public function setOdbiorca(?Person $odbiorca): self
    {
        $this->odbiorca = $odbiorca;

        return $this;
    }

    /**
     * @return Collection|PozycjaFaktura[]
     */
    public function getPozycje(): Collection
    {
        return $this->pozycje;
    }

    public function addPozycje(PozycjaFaktura $pozycje): self
    {
        if (!$this->pozycje->contains($pozycje)) {
            $this->pozycje[] = $pozycje;
            $pozycje->setFaktura($this);
        }
        $this->setValue();

        return $this;
    }

    public function removePozycje(PozycjaFaktura $pozycje): self
    {
        if ($this->pozycje->removeElement($pozycje)) {
            // set the owning side to null (unless already changed)
            if ($pozycje->getFaktura() === $this) {
                $pozycje->setFaktura(null);
            }
        }
        $this->setValue();

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(): self
    {
        $value = 0.00;
        foreach ($this->getPozycje() as $pozycja) {
            $value += $pozycja->getValue();
        }
        $this->value = $value;

        return $this;
    }
}
