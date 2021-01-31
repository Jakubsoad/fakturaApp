<?php


namespace App\Controller;


use App\Entity\Faktura;
use App\Entity\Person;
use App\Entity\PozycjaFaktura;
use App\Repository\PozycjaFakturaRepository;
use Doctrine\DBAL\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FakturaController
 * @package FakturaApp\Controller
 * @Route("/faktura", name="controller.faktura")
 */
class FakturaController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /** @var PozycjaFakturaRepository */
    private $pozycjaRepository;

    public function __construct(PozycjaFakturaRepository $pozycjaRepository)
    {
        $this->pozycjaRepository = $pozycjaRepository;
    }

    /**
     * @Route("/add", name="controller.faktura.add")
     * Testowa metoda do utworzenia faktury i dodania wszystkich powiązań
     */
    public function addNewFaktura()
    {
        $em = $this->getDoctrine()->getManager();

        $nabywca = new Person();
        $nabywca->setName('Adam');
        $nabywca->setSurname('Nowak');
        $nabywca->setAddress('Gdansk');

        $em->persist($nabywca);

        $odbiorca = new Person();
        $odbiorca->setName('Piotr');
        $odbiorca->setSurname('Kowalski');
        $odbiorca->setAddress('Gdynia');

        $em->persist($odbiorca);

        $faktura = new Faktura();
        $faktura->setNabywca($nabywca);
        $faktura->setOdbiorca($odbiorca);

        $em->persist($faktura);

        $pozycja1 = new PozycjaFaktura();
        $pozycja1->setName('Usluga1');
        $pozycja1->setValue(13.23);

        $em->persist($pozycja1);

        $pozycja2 = new PozycjaFaktura();
        $pozycja2->setName('Usluga2');
        $pozycja2->setValue(98.32);

        $em->persist($pozycja2);

        $pozycja3 = new PozycjaFaktura();
        $pozycja3->setName('Usluga3');
        $pozycja3->setValue(23.32);

        $em->persist($pozycja3);

        $faktura->addPozycje($pozycja1);
        $faktura->addPozycje($pozycja2);
        $faktura->addPozycje($pozycja3);

        $em->persist($faktura);

        $em->flush();

        return new Response('Success!');
    }

    /**
     * @param Faktura $faktura
     * @param PozycjaFaktura $pozycja
     * @return Response
     * @Route("/remove/{faktura}/{pozycja}")
     */
    public function removePozycjaFaktura(Faktura $faktura, PozycjaFaktura $pozycja)
    {
        $faktura->removePozycje($pozycja);

        return new Response("Poprawnie usunięto pozycję z faktury");
    }
}