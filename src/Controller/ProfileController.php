<?php

namespace App\Controller;

use App\Form\ProfileType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if (($form->isSubmitted() && $form->isValid())) {
            $userRepository->add($user, true);

            $this->addFlash('success', 'Votre profil a bien été modifié.');

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('profile/index.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
