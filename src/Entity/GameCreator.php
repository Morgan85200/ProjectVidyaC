<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameCreatorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameCreatorRepository::class)]
#[ApiResource]
class GameCreator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Game $game_id = null;

    #[ORM\ManyToOne]
    private ?Creator $creator_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameId(): ?Game
    {
        return $this->game_id;
    }

    public function setGameId(?Game $game_id): self
    {
        $this->game_id = $game_id;

        return $this;
    }

    public function getCreatorId(): ?Creator
    {
        return $this->creator_id;
    }

    public function setCreatorId(?Creator $creator_id): self
    {
        $this->creator_id = $creator_id;

        return $this;
    }
}
