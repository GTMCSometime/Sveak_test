<?php

namespace App\Scoring;
use App\Entity\User;

abstract class AbstractScore 
{

    public function __construct(public $score = 0) {
        $this->score = $score;
    }

}
