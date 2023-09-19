<?php

namespace App\Controller;

use App\Repository\GameRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{

    public GameRepository $gameRepository;
    public UserRepository $userRepository;
    public ReviewRepository $reviewRepository;

    public function __construct (GameRepository $gameRepository, UserRepository $userRepository, ReviewRepository $reviewRepository) {
        $this->gameRepository = $gameRepository;
        $this->userRepository = $userRepository;
        $this->reviewRepository = $reviewRepository;
    }

    #[Route('/user/{id}/profile', name: 'user_profile')]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Erreur : Utilisateur pas trouvé');
        }

        return $this->render('user_profile/profile.html.twig', [
            'controller_name' => 'UserProfileController',
        ]);
    }
}
