<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Entity\Student;
use App\Form\ExperienceType;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use App\Repository\ExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\Entity\Skill;

/**
 * @Route("/student")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/", name="student_index", methods="GET")
     * @IsGranted("ROLE_ADMIN", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function index(StudentRepository $studentRepository): Response
    {
        return $this->render('student/index.html.twig', ['students' => $studentRepository->findAll()]);
    }

    /**
     * @Route("/new", name="student_new", methods="GET|POST")
     * @IsGranted("ROLE_STUDENT", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function new(Request $request): Response
    {
        if ($student = $this->getUser()->getStudent()) {
            $this->addFlash(
                'danger',
                'Vous avez déjà crée un profil Etudiant'
            );
            return $this->redirectToRoute('student_profile');
        }

        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $student->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();


            return $this->redirectToRoute('student_profile', ['_fragment' => 'profil-tab']);
        }

        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_show", methods="GET", requirements={"id"="\d+"})
     */
    public function show(Student $student, Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            return $this->render('student/show_modal.html.twig', ['student' => $student]);
        }
        return $this->render('student/show.html.twig', ['student' => $student]);
    }

    /**
     * @Route("/profile", name="student_profile", methods="GET")
     * @IsGranted("ROLE_STUDENT", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function profile(): Response
    {
        $student = $this->getUser()->getStudent();
        return $this->render('student/show.html.twig', ['student' => $student]);
    }

    /**
     * @Route("/profile/edit", name="student_edit", methods="GET|POST")
     * @IsGranted("ROLE_STUDENT", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function edit(Request $request): Response
    {
        $student = $this->getUser()->getStudent();
        if (!$student) {
            return $this->redirectToRoute('student_new');
        }

        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                $student->setImageFile(null);

                $this->addFlash(
                    'success',
                    'Les modifications ont bien été enregistrées'
                );
                return $this->redirectToRoute('student_profile', ['_fragment' => 'profil-tab']);
            } else {
                $student->setImageFile(null);
            }
        }
        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_delete", methods="DELETE")
     * @IsGranted("ROLE_STUDENT", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     * @IsGranted("ROLE_ADMIN", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function delete(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete' . $student->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($student);
            $em->flush();
            session_destroy();
        }
        return $this->redirectToRoute('app_logout');
    }
}
