<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserScore;
use App\Form\EditFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class EditUserController extends AbstractController
{
    #[Route('/user/{id}/edit', name: 'edit_user')]
    public function edit(User $user, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(EditFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->flush();

            return $this->redirectToRoute('show_users');
        }

        return $this->render('users/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
