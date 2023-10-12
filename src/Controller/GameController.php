<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;
use App\Dto\GameDto;
use App\Entity\GameCreator;
use App\Entity\GamePlatform;
use App\Entity\GameUser;
use App\Entity\Review;
use App\Entity\Game;
use Doctrine\Persistence\ManagerRegistry;

class GameController extends AbstractController
{
    public GameRepository $gameRepository;

    public function __construct (GameRepository $gameRepository) {
    $this->gameRepository = $gameRepository;
    }

    
    #[Route('/game/{id}', name: 'game_test')]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $game = $this->gameRepository->find($id);

        if (!$game) {
            throw $this->createNotFoundException('Game not found');
        }

        $creatorsNames = $doctrine->getRepository(GameCreator::class)->getAllCreatorsName($id);
        $platformsNames = $doctrine->getRepository(GamePlatform::class)->getAllPlatformsName($id);
        $reviews = $doctrine->getRepository(Review::class)->getAllReviews($id);

        $gameDto = new GameDto($game);
        $gameDto->image = $game->getImage();
        $gameDto->banner = $game->getBanner();
        $gameDto->title = $game->getTitle();
        $gameDto->description = $game->getDescription();

        return $this->render('game/game.html.twig', [
            'game' => $gameDto,
            'creatorNames' => $creatorsNames,
            'platformNames' => $platformsNames,
            'reviews' => $reviews 
        ]);
    }

    #[Route('/game/{id}/addGameToList', name: 'addGameToList')]
    public function addToUserList(ManagerRegistry $doctrine, $id): Response
    {
        // Get the authenticated user
        $user = $this->getUser();

        // Get the game based on the $id
        $game = $doctrine->getRepository(Game::class)->find($id);

        if (!$game) {
            throw $this->createNotFoundException('Game not found');
        }

        // Create a new GameUser entity and associate the user and game
        $gameUser = new GameUser();
        $gameUser->setUserId($user);
        $gameUser->setGameId($game);

        // Set any other properties you need, such as note, status, timeSpent, etc.
        // $gameUser->setNote(5);
        // $gameUser->setStatut('In Progress');
        // $gameUser->setTimeSpent(10);

        // Set IsFavorited to true if you want to mark it as a favorite
        $gameUser->setIsFavorited(false);
        // Save the GameUser entity to the database
        $entityManager = $doctrine->getManager();
        $entityManager->persist($gameUser);
        $entityManager->flush();

        // Redirect the user back to the game page
        return $this->redirectToRoute('game_test', ['id' => $id]);
    }

    }

