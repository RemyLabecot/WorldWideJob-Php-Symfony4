<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 28/11/18
 * Time: 15:00
 */

namespace App\Controller;

use App\Form\EarlyBirdType;
use App\Security\LoginFormAuthenticator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class WelcomeController extends AbstractController
{
    /**
     *
     * @Route("/", name="early_welcome")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param \Swift_Mailer $mailer
     * @return Response
     * @throws \Exception
     */
    public function earlyIndex(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        \Swift_Mailer $mailer,
        LoginFormAuthenticator $authenticator
    ) : Response {

        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $authenticator->getProfilePage($this->getUser());
        }
        $user = new User();
        $form = $this->createForm(EarlyBirdType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setPlainPassword(bin2hex(random_bytes(10)));
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setRoles(array($form['role']->getData()));
            $em->persist($user);
            $em->flush();
            $this->addFlash(
                'success',
                'Un email contenant votre mot de passe vous a été envoyé.'
            );
            $mailFrom = $this->getParameter('mailer_from');
            $message = (new \Swift_Message('Inscription validé'))
                ->setFrom($mailFrom)
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        // templates/emails/registration.html.twig
                        'emails/preRegistration.html.twig',
                        array('user' => $user)
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);
            return $this->redirectToRoute('early_welcome');
        }

        return $this->render('tempwelcome/temp_welcome.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
