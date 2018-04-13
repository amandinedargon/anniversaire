<?php

    namespace App\Controller;

    use App\Form\ContactType;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class DefaultController extends AbstractController
    {
        /**
         * @Route("/invitation", name="home")
         */
        public function index(Request $request, \Swift_Mailer $mailer)
        {
            $form = $this->createForm(ContactType::class);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $contactFormData = $form->getData();

                $message = (new \Swift_Message('Réponse Invitation Anniversaire'))
                    ->setFrom($contactFormData['email'])
                    ->setTo('anniversaire.reponse@gmail.com')
                    ->setBody(
                        $this->renderView(
                            'emails/registration.html.twig',
                            array('nom' => $contactFormData['nom'], 'message' => $contactFormData['message'], 'participe' =>$contactFormData['participe'], 'email' =>$contactFormData['email'])
                        ),
                        'text/html'
                    );

                $mailer->send($message);

                $this->addFlash('success', 'Votre message a bien été envoyé!');

            }

            return $this->render('default/index.html.twig', [
                'controller_name' => 'WelcomeController',
                'my_form' => $form->createView()
            ]);

        }
    }
