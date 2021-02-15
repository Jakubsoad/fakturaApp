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
     * @ORM\OneToMany(targetEntity=Invoice::class, mappedBy="person")
     */
    private $invoiceBuyer;

    /**
     * @ORM\OneToMany(targetEntity=Invoice::class, mappedBy="recipient")
     */
    private $invoiceRecipient;

    public function __construct()
    {
        $this->invoiceBuyer = new ArrayCollection();
        $this->invoiceRecipient = new ArrayCollection();
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
     * @return Collection|Invoice[]
     */
    public function getInvoiceBuyer(): Collection
    {
        return $this->invoiceBuyer;
    }

    public function addInvoice(Invoice $invoice): self
    {
        if (!$this->invoiceBuyer->contains($invoice)) {
            $this->invoiceBuyer[] = $invoice;
            $invoice->setBuyer($this);
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): self
    {
        if ($this->invoiceBuyer->removeElement($invoice)) {
            // set the owning side to null (unless already changed)
            if ($invoice->getBuyer() === $this) {
                $invoice->setBuyer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Invoice[]
     */
    public function getInvoiceRecipient(): Collection
    {
        return $this->invoiceRecipient;
    }

    public function addInvoiceRecipient(Invoice $invoiceRecipient): self
    {
        if (!$this->invoiceRecipient->contains($invoiceRecipient)) {
            $this->invoiceRecipient[] = $invoiceRecipient;
            $invoiceRecipient->setRecipient($this);
        }

        return $this;
    }

    public function removeInvoiceRecipient(Invoice $invoiceRecipient): self
    {
        if ($this->invoiceRecipient->removeElement($invoiceRecipient)) {
            if ($invoiceRecipient->getRecipient() === $this) {
                $invoiceRecipient->setRecipient(null);
            }
        }

        return $this;
    }
}
