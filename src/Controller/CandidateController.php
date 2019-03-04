<?php
/**
 * Created by PhpStorm.
 * User: chady
 * Date: 16/01/19
 * Time: 10:12
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

class CandidateController extends AbstractController
{

    /**
     * @Route("/add/candidate/{id}", name="add_candidate", methods="GET|POST")
     * @IsGranted("ROLE_STUDENT")
     */

    public function addToCandidate(Offer $offer): Response
    {
        $this->getUser()->getStudent()
            ->addApplicant($offer);

        $this->getDoctrine()->getManager()
            ->flush();

        $this->addFlash(
            'success',
            'Votre candidature a bien été enregistrée'
        );

        return $this->redirectToRoute('offer_show', ['id' => $offer->getId()]);
    }
    /**
     * @Route("/delete/candidate/{id}", name="delete_candidate", methods="GET|POST")
     * @IsGranted("ROLE_STUDENT")
     */

    public function deleteToCandidate(Offer $offer): Response
    {
        $this->getUser()->getStudent()
            ->removeApplicant($offer);

        $this->getDoctrine()->getManager()
            ->flush();

        $this->addFlash(
            'danger',
            'Votre candidature a bien été supprimée'
        );

        return $this->redirectToRoute('offer_show', ['id' => $offer->getId()]);
    }
}
