<?php


namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Service\InvoiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InvoiceController
 * @Route("/invoice", name="controller.invoice")
 */
class InvoiceController extends AbstractController
{
    /** @var InvoiceService */
    private $invoiceService;

    /**
     * InvoiceController constructor.
     * @param InvoiceService $invoiceService
     */
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * @Route("/create-example", name="controller.invoice.create_example")
     * @return Response
     */
    public function createExampleInvoice(): Response
    {
        $this->invoiceService->createExampleInvoice();

        return new Response('Success!');
    }

    /**
     * @param Invoice $invoice
     * @param InvoiceItem $item
     * @return Response
     * @Route("/remove/{invoice}/{item}")
     */
    public function removeItemInvoice(Invoice $invoice, InvoiceItem $item): Response
    {
        $this->invoiceService->removeItem($invoice, $item);

        return new Response("Poprawnie usunięto pozycję z faktury");
    }
}
