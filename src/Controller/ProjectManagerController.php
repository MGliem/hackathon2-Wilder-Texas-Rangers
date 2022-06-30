<?php

namespace App\Controller;

use App\Entity\Matching as Mat;
use App\Entity\Project;
use App\Entity\User;
use App\Repository\MatchingRepository;
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
    public function openUsers(MatchingRepository $matchingRepository): Response
    {
        $matching = $matchingRepository->findOneBy(['apsidianLike' => true, 'masterChief' => null]);
        return $this->render('manager/adopt.html.twig', [
            'm' => $matching,
        ]);
    }

    #[Route('/adopt/add/{mat}', name: 'adopt_add')]
    public function addUser(Mat $mat, MatchingRepository $matchingRepository): Response
    {
        $mat->setMasterChief($this->getUser());
        $matchingRepository->add($mat, true);
        return $this->redirectToRoute('manager_adopt');
    }

    #[Route('/adopt/reject/{mat}', name: 'adopt_reject')]
    public function rejectProject(Mat $mat, MatchingRepository $matchingRepository): Response
    {
        $mat->setMasterChief($this->getUser());
        $mat->setApsidianLike(false);
        $matchingRepository->add($mat, true);
        return $this->redirectToRoute('manager_adopt');
    }
}
