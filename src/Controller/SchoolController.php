<?php

namespace App\Controller;

use App\Entity\School;
use App\Form\SchoolType;
use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/school")
 */
class SchoolController extends AbstractController
{
    /**
     * @Route("/", name="school_index", methods="GET")
     * @IsGranted("ROLE_ADMIN", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function index(SchoolRepository $schoolRepository): Response
    {
        return $this->render('school/index.html.twig', ['schools' => $schoolRepository->findAll()]);
    }

    /**
     * @Route("/new", name="school_new", methods="GET|POST")
     * @IsGranted("ROLE_SCHOOL", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function new(Request $request): Response
    {
        if ($school = $this->getUser()->getSchool()) {
            $this->addFlash(
                'danger',
                'Vous avez déjà crée un profil de Formation'
            );
            return $this->redirectToRoute('school_profile');
        }

        $school = new School();
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $school->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($school);
            $em->flush();

            return $this->redirectToRoute('school_profile');
        }

        return $this->render('school/new.html.twig', [
            'school' => $school,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="school_show", methods="GET", requirements={"id"="\d+"})
     */
    public function show(School $school): Response
    {

        return $this->render('school/show.html.twig', ['school' => $school]);
    }

    /**
     * @Route("/profile", name="school_profile", methods="GET")
     * @IsGranted("ROLE_SCHOOL", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function profile(): Response
    {
        $school = $this->getUser()->getSchool();
        return $this->render('school/show.html.twig', ['school' => $school]);
    }

    /**
     * @Route("/profile/edit", name="school_edit", methods="GET|POST")
     * @IsGranted("ROLE_SCHOOL", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function edit(Request $request): Response
    {
        /**
         * @var School $school
         */
        $school = $this->getUser()->getSchool();
        if (!$school) {
            return $this->redirectToRoute('school_new');
        }
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash(
                    'success',
                    'Les modifications ont bien été enregistré'
                );

                $school->setImageFile(null);
                return $this->redirectToRoute('school_profile');
            } else {
                $school->setImageFile(null);
            }
        }

        return $this->render('school/edit.html.twig', [
            'school' => $school,
            'form' => $form->createView(),
        ]);
    }
}
