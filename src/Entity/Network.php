<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\NetworkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NetworkRepository::class)]
#[ApiResource]
class Network
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'networks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $initiator_id = null;

    #[ORM\ManyToOne(inversedBy: 'networksReceiver')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $receiver_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitiatorId(): ?User
    {
        return $this->initiator_id;
    }

    public function setInitiatorId(?User $initiator_id): self
    {
        $this->initiator_id = $initiator_id;

        return $this;
    }

    public function getReceiverId(): ?User
    {
        return $this->receiver_id;
    }

    public function setReceiverId(?User $receiver_id): self
    {
        $this->receiver_id = $receiver_id;

        return $this;
    }
}
