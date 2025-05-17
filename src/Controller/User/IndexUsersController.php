<?php

namespace App\Controller\User;

use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class IndexUsersController extends AbstractController
{
    #[Route('/users', name: 'index_users')]


    public function show(Request $request, UserRepository $userRepository, PaginatorInterface $paginator): Response
    {
        $query = $userRepository->createQueryBuilder('u')
        ->orderBy('u.id', 'ASC');

        $pagination = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1), 
            10 
        );
        return $this->render('users/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
