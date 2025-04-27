<?php

namespace App\Services;

abstract class AbstractScore 
{

    public function __construct(public $score = 0) {
        $this->score = $score;
    }

}
