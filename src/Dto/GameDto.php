<?php
namespace App\Dto;

use App\Entity\Game;
use DateTimeInterface;

class GameDto
{
    public int $id;
    public string $title;
    public string $description;
    public ?\DateTimeInterface $releaseDate;
    public string $image;
    public string $banner;

    public function __construct (Game $game) {
        $this->id = $game->getId();
        $this->title = $game->getTitle();
        $this->description = $game->getDescription();
        $this->releaseDate = $game->getReleaseDate();
        $this->image = $game->getImage();
        $this->banner = $game->getBanner();
    }

}
