<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Dto\GameDto;

class HomeController extends AbstractController
{
    public GameRepository $gameRepository;

    public function __construct (GameRepository $gameRepository) {
        $this->gameRepository = $gameRepository;

    }
       
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        $games = $this->gameRepository->findAll(); // Fetch all games from the database
        
        $gameDtos = [];
        foreach ($games as $game) {
            $dto = new GameDto($game);
            $dto->title = $game->getTitle();
            $dto->releaseDate = $game->getReleaseDate();
            $gameDtos[] = $dto;
        }

        return $this->render('home/home.html.twig', [
            'games' => $gameDtos,
        ]);
    }
}
