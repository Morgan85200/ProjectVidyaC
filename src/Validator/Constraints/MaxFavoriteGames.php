<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaxFavoriteGames extends Constraint
{
    public $message = 'You can only have {{ limit }} favorite games.';

    public function validatedBy()
    {
        return \get_class($this) . 'Validator';
    }
}
