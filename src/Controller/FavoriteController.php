<?php
/**
 * Created by PhpStorm.
 * User: chady
 * Date: 15/01/19
 * Time: 12:14
 */

namespace App\Controller;

use App\Entity\User;
use App\Entity\Student;
use App\Entity\Offer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FavoriteController extends AbstractController
{
    /**
     * @Route("/add/favorite/{id}", name="add_favorite", methods="GET|POST")
     * @IsGranted("ROLE_STUDENT")
     */

    public function addToFavorite(Offer $offer): Response
    {
        $this->getUser()->getStudent()
            ->addFavorite($offer);

        $this->getDoctrine()->getManager()
            ->flush();

        $this->addFlash(
            'success',
            'L\'offre a bien été ajouté a votre liste de favoris'
        );

        return $this->redirectToRoute('offer_show', ['id' => $offer->getId()]);
    }

    /**
     * @Route("/delete/favorite/{id}", name="delete_favorite", methods="GET|POST")
     * @IsGranted("ROLE_STUDENT")
     */

    public function deleteFavorite(Request $request, Offer $offer): Response
    {
        $this->getUser()->getStudent()
            ->removeFavorite($offer);

        $this->getDoctrine()->getManager()
            ->flush();

        $this->addFlash(
            'danger',
            'L\'offre a bien été supprimée de votre liste de favoris.'
        );
        $referer = $request->headers->get('referer');

        return new RedirectResponse($referer);
    }
}
