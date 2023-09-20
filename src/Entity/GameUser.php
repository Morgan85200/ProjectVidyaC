<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameUserRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints as CustomAssert;


#[ORM\Entity(repositoryClass: GameUserRepository::class)]
#[ApiResource]
class GameUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gameUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'gameUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $statut = null;

    #[ORM\Column(nullable: true)]
    private ?int $timeSpent = null;

    #[ORM\Column]
    #[CustomAssert\MaxFavoriteGames]
    private ?bool $IsFavorited = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getTimeSpent(): ?int
    {
        return $this->timeSpent;
    }

    public function setTimeSpent(?int $timeSpent): self
    {
        $this->timeSpent = $timeSpent;

        return $this;
    }

    public function isIsFavorited(): ?bool
    {
        return $this->IsFavorited;
    }

    public function setIsFavorited(bool $IsFavorited): self
    {
        $this->IsFavorited = $IsFavorited;

        return $this;
    }
}
