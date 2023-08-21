<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;
use App\Dto\GameDto;
use App\Entity\GameCreator;
use App\Entity\GamePlatform;
use App\Entity\Review;
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

        // foreach ($reviews as $review) {
        //     dump($review);
        // }
        // die();

        $gameDto = new GameDto($game);
        $gameDto->image = $game->getImage();
        $gameDto->banner = $game->getBanner();
        $gameDto->title = $game->getTitle();
        $gameDto->description = $game->getDescription();

        return $this->render('game/game.html.twig', [
            'game' => $gameDto,
            'creatorNames' => $creatorsNames[0],
            'platformNames' => $platformsNames,
            'reviews' => $reviews 
        ]);
    }
}

