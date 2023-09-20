<?php

namespace App\Validator\Constraints;

use App\Entity\GameUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MaxFavoriteGamesValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        $user = $this->context->getObject();

        // Count the number of favorite games for the user
        $favoriteGamesCount = $this->entityManager
            ->getRepository(GameUser::class)
            ->countFavoriteGames($user);

        if ($favoriteGamesCount >= 5) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ limit }}', 5)
                ->addViolation();
        }
    }
}