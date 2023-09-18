<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;
use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Dto\GameDto;
use App\Dto\ReviewDto;
use App\Form\GameSearchType;

class HomeController extends AbstractController
{
    public GameRepository $gameRepository;
    public ReviewRepository $reviewRepository;

    public function __construct (GameRepository $gameRepository, ReviewRepository $reviewRepository) {
        $this->gameRepository = $gameRepository;
        $this->reviewRepository = $reviewRepository;

    }
       
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        $games = $this->gameRepository->findMostRecentGames();
        $reviews = $this->reviewRepository->findMostRecentReviews();

        $gameDtos = [];
        $reviewDtos = [];
        foreach ($games as $game) {
            $dto = new GameDto($game);
            $dto->id = $game->getId();
            $dto->image = $game->getImage();
            $dto->title = $game->getTitle();
            $dto->releaseDate = $game->getReleaseDate();
            $gameDtos[] = $dto;
        }
        foreach ($reviews as $review) {
            $dto = new ReviewDto($review);
            $dto->id = $review->getId();
            $dto->userId = $review->getUserId()->getUsername();
            $dto->gameId = $review->getGameId()->getTitle();
            $dto->createdAt = $review->getCreatedAt();
            $dto->body = $review->getBody();
            $dto->note = $review->getNote();
            $reviewDtos[] = $dto;
        }

        return $this->render('home/home.html.twig', [
            'games' => $gameDtos,
            'reviews' => $reviewDtos,
        ]);
    }
}
