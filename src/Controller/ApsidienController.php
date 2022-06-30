<?php

namespace App\Controller;

use App\Entity\Matching;
use App\Entity\Project;
use App\Repository\MatchingRepository;
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

    #[Route('/adopt', name: 'adopt')]
    public function openProjects(ProjectRepository $projectRepository): Response
    {
        $project = $projectRepository->findOneBy(["status" => "open"]);
        return $this->render('apsidien/adopt.html.twig', [
            'project' => $project,
        ]);
    }

    #[Route('/adopt/add/{project}', name: 'adopt_add')]
    public function addProject(Project $project, ProjectRepository $projectRepository, MatchingRepository $matchingRepository): Response
    {
        $matching = new Matching();
        $matching->addApsidian($this->getUser());
        $matching->addProject($project);
        $matching->setLiked(1);
        return $this->redirectToRoute('apsidien_adopt');
    }
}
