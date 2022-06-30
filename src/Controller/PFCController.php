<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pfc')]
class PFCController extends AbstractController
{
    #[Route('/home', name: 'app_p_f_c')]
    public function index(RequestStack $stack): Response
    {
        $session = $stack->getSession();
        $session->set('life', 3);
        return $this->render('pfc/index.html.twig', [
        ]);
    }

    #[Route('/game', name: 'life_pfc')]
    public function life(RequestStack $stack): Response
    {
        $session = $stack->getSession();
        return $this->render('pfc/index.html.twig', [
        ]);
    }
    
    #[Route('/{play}', name: 'app_p_f_c_play')]
    public function play(RequestStack $stack, string $play, UserRepository $userRepository): Response
    {
        $session = $stack->getSession();
        $user = $this->getUser();
        if ($play === 'rocks') {
            $this->addFlash('danger', 'ApsiMan played paper : YOU LOSE !');
            $user->setPoints($user->getPoints() - 5);
            $session->set('life', $session->get('life')-1);
        }
        if ($play === 'scissor') {
            $this->addFlash('danger', 'ApsiMan played rocks : YOU LOSE !');
            $user->setPoints($user->getPoints() - 5);
            $session->set('life', $session->get('life')- 1);
        }
        if ($play === 'paper') {
            $this->addFlash('danger', 'ApsiMan played scissors : YOU LOSE !');
            $user->setPoints($user->getPoints() - 5);
            $session->set('life', $session->get('life')- 1);
        } else {
        }
        $userRepository->add($user, true);
        return $this->redirectToRoute('life_pfc');
    }
}
