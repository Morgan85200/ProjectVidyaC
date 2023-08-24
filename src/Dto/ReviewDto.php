<?php
namespace App\Dto;

use App\Entity\Review;
use App\Entity\User;
use DateTimeInterface;

class ReviewDto
{
    public int $id;
    public string $userId;
    public string $gameId;
    public ?\DateTimeInterface $createdAt;
    public string $body;
    public int $note;

    public function __construct (Review $review) {
        $this->id = $review->getId();
        $this->userId = $review->getUserId()->getUsername();
        $this->gameId = $review->getGameId()->getTitle();
        $this->createdAt = $review->getCreatedAt();
        $this->body = $review->getBody();
        $this->note = $review->getNote();
    }  
}
