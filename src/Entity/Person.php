<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
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
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Faktura::class, mappedBy="person")
     */
    private $fakturyNabywca;

    /**
     * @ORM\OneToMany(targetEntity=Faktura::class, mappedBy="odbiorca")
     */
    private $fakturaOdbiorca;

    public function __construct()
    {
        $this->fakturyNabywca = new ArrayCollection();
        $this->fakturaOdbiorca = new ArrayCollection();
    }

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Faktura[]
     */
    public function getFaktury(): Collection
    {
        return $this->fakturyNabywca;
    }

    public function addFaktury(Faktura $faktury): self
    {
        if (!$this->fakturyNabywca->contains($faktury)) {
            $this->fakturyNabywca[] = $faktury;
            $faktury->setNabywca($this);
        }

        return $this;
    }

    public function removeFaktury(Faktura $faktury): self
    {
        if ($this->fakturyNabywca->removeElement($faktury)) {
            // set the owning side to null (unless already changed)
            if ($faktury->getNabywca() === $this) {
                $faktury->setNabywca(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Faktura[]
     */
    public function getFakturaOdbiorca(): Collection
    {
        return $this->fakturaOdbiorca;
    }

    public function addFakturaOdbiorca(Faktura $fakturaOdbiorca): self
    {
        if (!$this->fakturaOdbiorca->contains($fakturaOdbiorca)) {
            $this->fakturaOdbiorca[] = $fakturaOdbiorca;
            $fakturaOdbiorca->setOdbiorca($this);
        }

        return $this;
    }

    public function removeFakturaOdbiorca(Faktura $fakturaOdbiorca): self
    {
        if ($this->fakturaOdbiorca->removeElement($fakturaOdbiorca)) {
            // set the owning side to null (unless already changed)
            if ($fakturaOdbiorca->getOdbiorca() === $this) {
                $fakturaOdbiorca->setOdbiorca(null);
            }
        }

        return $this;
    }
}
