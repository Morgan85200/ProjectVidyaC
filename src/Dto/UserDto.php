<?php
namespace App\Dto;

use App\Entity\User;

class UserDto
{
    public string $username;
    public ?string $bio = null;
    public ?string $profilePicture = null;

    public function __construct (User $user) {
        $this->username = $user->getUsername();
        $this->bio = $user->getBio();
        $this->profilePicture = $user->getProfilePicture();
    }  
}