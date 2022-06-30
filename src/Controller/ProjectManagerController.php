<?php

namespace App\Controller;

use App\Entity\Matching;
use App\Entity\Project;
use App\Entity\User;
use App\Repository\MatchingRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/manager', name: 'manager_')]
class ProjectManagerController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function indexManager(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('manager/home/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/adopt', name: 'adopt')]
    public function openUsers(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['matching' => 1]);
        return $this->render('manager/adopt.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/adopt/add/{user}', name: 'adopt_add')]
    public function addUser(MatchingRepository $matchingRepository): Response
    {
        $matching = $matchingRepository->findOneBy(['matching' => 1]);
        $matching->setLiked(3);
        $matchingRepository->add($matching, true);
        return $this->redirectToRoute('manager_adopt');
    }

    #[Route('/adopt/reject/{user}', name: 'adopt_reject')]
    public function rejectProject(MatchingRepository $matchingRepository): Response
    {
        $matching = $matchingRepository->findOneBy(['matching' => 1]);
        $matching->setLiked(4);
        $matchingRepository->add($matching, true);
        return $this->redirectToRoute('manager_adopt');
    }
}
