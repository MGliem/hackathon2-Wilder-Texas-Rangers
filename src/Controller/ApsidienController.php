<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/apsidien', name: 'apsidien_')]
class ApsidienController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function indexApsidien(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();
        return $this->render('apsidien/home/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
