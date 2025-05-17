<?php

namespace App\Tests;

use App\Entity\User;
use App\Services\CalculateTotalScoreService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculateScoreTest extends KernelTestCase
{
    private CalculateTotalScoreService $calculator;
    private User $user;


    protected function setUp(): void
    {
        self::bootKernel();
        $this->calculator = self::getContainer()->get(CalculateTotalScoreService::class);
        $this->user = new User();
    }


    public function testCalculateScore(): void
    {
        $this->user->setName('Test');
        $this->user->setSurname('Testovich');
        $this->user->setPhoneNumber('9232295589'); // +10
        $this->user->setEmail('test@gmail.com'); // +10
        $this->user->setEducation('higher'); // +15        
        $this->user->setAgreeTerms(true); // +4

        $score =  $this->calculator->calculate($this->user);
        $exp = 39;
        
        $this->assertEquals($exp, $score);
    }
}
