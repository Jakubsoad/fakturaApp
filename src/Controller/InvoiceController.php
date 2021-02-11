<?php


namespace App\Controller;


use App\Entity\Invoice;
use App\Entity\Person;
use App\Entity\InvoiceItem;
use App\Repository\InvoiceItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InvoiceController
 * @Route("/invoice", name="controller.invoice")
 */
class InvoiceController extends AbstractController
{
    /** @var InvoiceItemRepository */
    private $invoiceItemRepository;

    /**
     * InvoiceController constructor.
     * @param InvoiceItemRepository $invoiceItemRepository
     */
    public function __construct(InvoiceItemRepository $invoiceItemRepository)
    {
        $this->invoiceItemRepository = $invoiceItemRepository;
    }

    /**
     * @Route("/add", name="controller.invoice.add")
     */
    public function addNewInvoice()
    {
        $em = $this->getDoctrine()->getManager();

        $buyer = new Person();
        $buyer->setName('Adam');
        $buyer->setSurname('Nowak');
        $buyer->setAddress('Gdansk');

        $em->persist($buyer);

        $recipient = new Person();
        $recipient->setName('Piotr');
        $recipient->setSurname('Kowalski');
        $recipient->setAddress('Gdynia');

        $em->persist($recipient);

        $invoice = new Invoice();
        $invoice->setBuyer($buyer);
        $invoice->setRecipient($recipient);

        $em->persist($invoice);

        $item_1st = new InvoiceItem();
        $item_1st->setName('Usluga1');
        $item_1st->setValue(13.23);

        $em->persist($item_1st);

        $item_2nd = new InvoiceItem();
        $item_2nd->setName('Usluga2');
        $item_2nd->setValue(98.32);

        $em->persist($item_2nd);

        $item_3rd = new InvoiceItem();
        $item_3rd->setName('Usluga3');
        $item_3rd->setValue(23.32);

        $em->persist($item_3rd);

        $invoice->addItem($item_1st);
        $invoice->addItem($item_2nd);
        $invoice->addItem($item_3rd);

        $em->persist($invoice);

        $em->flush();

        return new Response('Success!');
    }

    /**
     * @param Invoice $invoice
     * @param InvoiceItem $item
     * @return Response
     * @Route("/remove/{invoice}/{item}")
     */
    public function removeItemInvoice(Invoice $invoice, InvoiceItem $item)
    {
        $invoice->removeItem($item);

        return new Response("Poprawnie usunięto pozycję z faktury");
    }
}