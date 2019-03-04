<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/", name="company_index", methods="GET")
     * @IsGranted("ROLE_ADMIN", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('company/index.html.twig', ['companies' => $companyRepository->findAll()]);
    }

    /**
     * @Route("/new", name="company_new", methods="GET|POST")
     * @isGranted("ROLE_COMPANY", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function new(Request $request): Response
    {
        if ($company = $this->getUser()->getCompany()) {
            $this->addFlash(
                'danger',
                'Vous avez déjà crée un profil d\'entreprise'
            );
            return $this->redirectToRoute('company_profile');
        }
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $company->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('company_profile');
        }

        return $this->render('company/new.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_show", methods="GET", requirements={"id"="\d+"})
     */
    public function show(Company $company): Response
    {

        return $this->render('company/show.html.twig', ['company' => $company]);
    }

    /**
     * @Route("/profile", name="company_profile", methods="GET")
     * @IsGranted("ROLE_COMPANY", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function profile(): Response
    {
        return $this->render('company/show.html.twig', ['company' => $this->getUser()->getCompany()]);
    }

    /**
     * @Route("/profile/edit", name="company_edit", methods="GET|POST")
     * @isGranted("ROLE_COMPANY", statusCode=404, message="Vous n'êtes pas autorisé à accéder à cette page.")
     */
    public function edit(Request $request): Response
    {
        /**
         * @var Company $company
         */
        $company = $this->getUser()->getCompany();
        if (!$company) {
            return $this->redirectToRoute('company_new');
        }

        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                $company->setImageFile(null);

                $this->addFlash(
                    'success',
                    'Les modifications ont bien été enregistrées'
                );
                return $this->redirectToRoute('company_profile');
            } else {
                $company->setImageFile(null);
            }
        }
        return $this->render('company/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }
}
