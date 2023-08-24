<?php
namespace App\Dto;

use App\Entity\User;

class UserDto
{
    public string $username;

    public function __construct (User $user) {
        $this->username = $user->getUsername();
    }  
}