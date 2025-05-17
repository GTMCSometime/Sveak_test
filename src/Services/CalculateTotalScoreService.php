<?php

namespace App\Services;
use App\Entity\User;

class CalculateTotalScoreService implements CalculateInterface  {

    public function __construct(
        private CalculatePhoneNumberService $calculatePhoneNumberService,
        private CalculateEmailService $calculateEmailService,
        private CalculateEducationService $calculateEducationService,
        private CalculateAgreeService $calculateAgreeService,
    ) {}


    public function calculate(User $user): int {
        return $this->calculatePhoneNumberService->calculate($user) 
            + $this->calculateEmailService->calculate($user) 
            + $this->calculateEducationService->calculate($user) 
            + $this->calculateAgreeService->calculate($user);
}
}