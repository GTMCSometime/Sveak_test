<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\EditFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class ShowUserController extends AbstractController
{
    #[Route('/user/{id}/show', name: 'show_user')]

    
    public function show(User $user, Request $request): Response
    {
        $form = $this->createForm(EditFormType::class, $user);
        $form->handleRequest($request);

        return $this->render('users/show.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
