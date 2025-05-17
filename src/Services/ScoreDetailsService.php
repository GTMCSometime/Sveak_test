<?php

namespace App\Services;
use App\Entity\User;

class ScoreDetailsService  {
    public function __construct(
        private CalculatePhoneNumberService $calculatePhoneNumberService,
        private CalculateEmailService $calculateEmailService,
        private CalculateEducationService $calculateEducationService,
        private CalculateAgreeService $calculateAgreeService,
        private CalculateTotalScoreService $calculateTotalScoreService,
    ) {}

    
    public function scoreDetails(User $user): array {
        $data = [];

        $data['phoneNumber'] = $this->calculatePhoneNumberService->calculate($user);
        $data['email'] = $this->calculateEmailService->calculate($user);
        $data['education'] = $this->calculateEducationService->calculate($user);
        $data['agree'] = $this->calculateAgreeService->calculate($user);
        $data['score'] = $this->calculateTotalScoreService->calculate($user);

        return $data;
}

}