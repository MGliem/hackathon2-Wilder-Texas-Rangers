<?php

namespace App\Controller;

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
    public function play(string $play): Response
    {
        
        if ($play === 'rocks') {
            $this->addFlash('danger', 'ApsiMan played paper : YOU LOOSE !');
        }
        if ($play === 'scissor') {
            $this->addFlash('danger', 'ApsiMan played rocks : YOU LOOSE !');
        }
        if ($play === 'paper') {
            $this->addFlash('danger', 'ApsiMan played scissors : YOU LOOSE !');
        } else {
        }
        return $this->redirectToRoute('app_p_f_c');
    }
}
