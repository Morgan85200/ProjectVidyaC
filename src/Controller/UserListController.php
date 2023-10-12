<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use App\Repository\GameUserRepository;
use App\Repository\GameCreatorRepository;
use App\Dto\GameDto;
use App\Entity\GameUser;
use App\Entity\GameCreator;
use App\Entity\GamePlatform;
use Doctrine\Persistence\ManagerRegistry;
use App\Dto\UserDto;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserListController extends AbstractController
{
    public GameRepository $gameRepository;
    public UserRepository $userRepository;

    public function __construct (GameRepository $gameRepository, UserRepository $userRepository) {
        $this->gameRepository = $gameRepository;
        $this->userRepository = $userRepository;
    }

    #[Route('/user/{id}/list', name: 'user_list')]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Erreur : Utilisateur pas trouvé');
        }

        $currentUser = $this->getUser(); // Get the currently logged-in user
        if (!$currentUser) {
            throw new AccessDeniedException('Access denied. You are not logged in.');
        }
        
        if ((int)$currentUser->getId() !== (int)$id) {
            throw new AccessDeniedException('Access denied. You are not authorized to view this page.');
        }
        

        $userGames = $doctrine->getRepository(GameUser::class)->getAllGamesfromUser($id);
        $creatorsNames = $doctrine->getRepository(GameCreator::class)->getAllCreatorsName($id);
        $platformsNames = $doctrine->getRepository(GamePlatform::class)->getAllPlatformsName($id);

        $userDto = new UserDto($user);
        $userDto->username = $user->getUsername();

        return $this->render('user_list/list.html.twig', [
            'user' => $userDto,
            'userGames' => $userGames,
            'creatorNames' => $creatorsNames,
            'platformNames' => $platformsNames,
        ]);
    }
}
