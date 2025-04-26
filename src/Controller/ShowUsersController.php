<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


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
