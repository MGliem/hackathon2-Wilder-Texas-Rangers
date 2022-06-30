<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pfc')]
class PFCController extends AbstractController
{
    #[Route('/home', name: 'app_p_f_c')]
    public function index(): Response
    {
        return $this->render('pfc/index.html.twig', [
        ]);
    }

    #[Route('/{play}', name: 'app_p_f_c_play')]
    public function play(string $play, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        if ($play === 'rocks') {
            $this->addFlash('danger', 'ApsiMan played paper : YOU LOOSE !');
            $user->setPoints($user->getPoints() - 5);
        }
        if ($play === 'scissor') {
            $this->addFlash('danger', 'ApsiMan played rocks : YOU LOOSE !');
            $user->setPoints($user->getPoints() - 5);
        }
        if ($play === 'paper') {
            $this->addFlash('danger', 'ApsiMan played scissors : YOU LOOSE !');
            $user->setPoints($user->getPoints() - 5);
        } else {
        }
        $userRepository->add($user, true);
        return $this->redirectToRoute('app_p_f_c');
    }
}
