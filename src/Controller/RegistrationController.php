<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('firstname',TextType::class)
            ->add('lastname',TextType::class)
            ->add('avatar', FileType::class, array('label' => 'file'))
            ->add('email',EmailType::class)
            ->add('password',PasswordType::class)
            ->add('save',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            //permet d'encrypter les password pour la bdd
            $plainPassword = $user->getPassword();
            $encryptedPassword = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encryptedPassword);
            //fichier recuperer via form
            $avatarFile = $user->getAvatar();
            $entityManager = $this->getDoctrine()->getManager();
            //nom du fichier qui sera mis dans la bdd
            $user->setAvatarFileName( md5(uniqid()).'.'.$avatarFile->guessExtension());
            $entityManager->persist($user);

            $avatarFile->move(
                $this->getParameter('file_directory'),
                $user->getAvatarFileName()
            );

            $entityManager->flush();

            return $this->redirectToRoute('/homepage');
        }
        return $this->render('registration/index.html.twig', [
            'formUser' => $form->createView()
        ]);

    }

}
