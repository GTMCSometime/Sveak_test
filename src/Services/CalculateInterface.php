<?php

namespace App\Services;
use App\Entity\User;

interface CalculateInterface  {
    public function calculate(User $user): int;

}