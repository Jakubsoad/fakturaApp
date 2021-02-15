<?php


namespace App\Service;

use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class InvoiceService
 * @package App\Service
 */
class InvoiceService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function createExampleInvoice(): void
    {
        $buyer = $this->createNewPerson('Adam', 'Nowak', 'Gdansk');
        $recipient = $this->createNewPerson('Piotr', 'Kowalski', 'Gdynia');
        $invoice = $this->createNewInvoice($buyer, $recipient);
        $item_1st = $this->createNewItem('Usluga1', 13.23);
        $item_2nd = $this->createNewItem('Usluga2', 98.23);
        $item_3rd = $this->createNewItem('Usluga3', 897);
        $this->addItemsToInvoice($invoice, [$item_1st, $item_2nd, $item_3rd]);

        $this->entityManager->flush();
    }

    /**
     * @param string $name
     * @param string $surname
     * @param string $address
     * @return Person
     */
    private function createNewPerson(string $name, string $surname, string $address): Person
    {
        $person = new Person();
        $person->setName($name);
        $person->setSurname($surname);
        $person->setAddress($address);

        $this->entityManager->persist($person);

        return $person;
    }

    /**
     * @param Person $buyer
     * @param Person $recipient
     * @return Invoice
     */
    private function createNewInvoice(Person $buyer, Person $recipient): Invoice
    {
        $invoice = new Invoice();
        $invoice->setBuyer($buyer);
        $invoice->setRecipient($recipient);

        $this->entityManager->persist($invoice);

        return $invoice;
    }


    /**
     * @param Invoice $invoice
     * @param InvoiceItem $item
     */
    public function removeItem(Invoice $invoice, InvoiceItem $item): void
    {
        $invoice->removeItem($item);

        $this->entityManager->persist($invoice);
        $this->entityManager->flush();
    }

    /**
     * @param string $name
     * @param float $value
     * @return InvoiceItem
     */
    private function createNewItem(string $name, float $value): InvoiceItem
    {
        $item = new InvoiceItem();
        $item->setName($name);
        $item->setValue($value);

        $this->entityManager->persist($item);

        return $item;
    }
    /**
     * @param Invoice $invoice
     * @param array $items
     */
    private function addItemsToInvoice(Invoice $invoice, array $items): void
    {
        foreach ($items as $item) {
            if ($item instanceof InvoiceItem) {
                $invoice->addItem($item);
            }
        }

        $this->entityManager->persist($invoice);
    }
}
