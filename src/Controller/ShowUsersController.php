<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserScore;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Scoring\ScoreService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class ShowUsersController extends AbstractController
{
    #[Route('/users', name: 'show_users')]
    public function show(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('users/show.html.twig', [
            'users' => $users,
        ]);
    }
}
