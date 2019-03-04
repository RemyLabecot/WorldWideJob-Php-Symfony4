<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferSearchType;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/offer")
 */
class OfferController extends AbstractController
{

    private $elasticaManager;

    public function __construct(RepositoryManagerInterface $elasticaManager)
    {
        $this->elasticaManager = $elasticaManager;
    }

    /**
     * @Route("/", name="offer_index", methods="GET")
     * @param OfferRepository $offerRepository
     * @param Request $request
     * @return Response
     */
    public function index(OfferRepository $offerRepository, Request $request): Response
    {
        $form = $this->createForm(
            OfferSearchType::class,
            null,
            ['method' => Request::METHOD_GET]
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $finder = $this->elasticaManager->getRepository(Offer::class);
            if ($data['search_filter'] === true) {
                $text = $data['search_offer'];
                $results = $finder->find($text);
                //TODO: pagination
            } else {
                $boolQuery = new \Elastica\Query\BoolQuery();
                $text = $data['search_offer'];
                $filter = $data['search_filter'];
                
                $fieldQuery = new \Elastica\Query\Match();
                $fieldQuery->setFieldQuery('title', $text);
                $fieldQuery->setFieldParam('title', 'analyzer', 'my_analyzer');
                $boolQuery->addMust($fieldQuery);
                
                $filterQuery = new \Elastica\Query\Match();
                $filterQuery->setField('type', $filter);
                $boolQuery->addFilter($filterQuery);

                $results = $finder->find($boolQuery);
            }
        } else {
            $results = $offerRepository->findAll();
        }
        return $this->render('offer/index.html.twig', [
            'offers' => $results ?? [],
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="offer_new", methods="GET|POST")
     * @Security("is_granted('ROLE_COMPANY')",
     *  statusCode=404, message="Vous ne pouvez pas accéder à cette page")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $offer->setCompany($this->getUser()->getCompany());
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute('offer_index');
        }
        return $this->render('offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offer_show", methods="GET", requirements={"id":"\d+"})
     * @param Offer $offer
     * @return Response
     */
    public function show(Offer $offer): Response
    {
        return $this->render('offer/show.html.twig', ['offer' => $offer]);
    }

    /**
     * @Route("/{id}/edit", name="offer_edit", methods="GET|POST")
     * @Security("is_granted('ROLE_COMPANY')",
     *  statusCode=404, message="Vous ne pouvez pas accéder à cette page")
     * @param Request $request
     * @param Offer $offer
     * @return Response
     */
    public function edit(Request $request, Offer $offer): Response
    {
        $currentCompany = $this->getUser()->getCompany();
        $offerCompany = $offer->getCompany();

        if ($currentCompany != $offerCompany) {
            return $this->redirectToRoute('offer_new');
        }
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offer_index', ['id' => $offer->getId()]);
        }

        return $this->render('offer/edit.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offer_delete", methods="DELETE")
     * @Security("is_granted('ROLE_COMPANY')",
     *  statusCode=404, message="Vous ne pouvez pas accéder à cette page")
     * @param Request $request
     * @param Offer $offer
     * @return Response
     */
    public function delete(Request $request, Offer $offer): Response
    {
        $currentCompany = $this->getUser()->getCompany();
        $offerCompany = $offer->getCompany();

        if ($currentCompany != $offerCompany) {
            return $this->redirectToRoute('offer_new');
        } elseif ($this->isCsrfTokenValid('delete' . $offer->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offer);
            $em->flush();
        }
        return $this->redirectToRoute('offer_index');
    }
}
