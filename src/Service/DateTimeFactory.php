<?php

namespace App\Service;

use DateTimeImmutable;

class DateTimeFactory
{
    public function createDateTimeImmutable($dateString): DateTimeImmutable
    {
        return new DateTimeImmutable($dateString);
    }
}