<?php


namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="invoiceBuyer")
     */
    private $buyer;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="invoiceRecipient")
     */
    private $recipient;

    /**
     * @ORM\OneToMany(targetEntity=InvoiceItem::class, mappedBy="invoice")
     */
    private $items;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $value;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuyer(): ?Person
    {
        return $this->buyer;
    }

    public function setBuyer(?Person $buyer): self
    {
        $this->buyer = $buyer;

        return $this;
    }

    public function getRecipient(): ?Person
    {
        return $this->recipient;
    }

    public function setRecipient(?Person $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * @return Collection|InvoiceItem[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(InvoiceItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setInvoice($this);
        }
        $this->setValue();

        return $this;
    }

    public function removeItem(InvoiceItem $item): self
    {
        if ($this->items->removeElement($item)) {
            if ($item->getInvoice() === $this) {
                $item->setInvoice(null);
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
        foreach ($this->getItems() as $item) {
            $value += $item->getValue();
        }
        $this->value = $value;

        return $this;
    }
}
