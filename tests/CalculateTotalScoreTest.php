<?php

namespace App\Tests;

use App\Entity\User;
use App\Services\CalculateTotalScoreService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculateTotalScoreTest extends KernelTestCase
{
    private CalculateTotalScoreService $calculator;
    private User $firstUser;
    private User $secondUser;


    protected function setUp(): void
    {
        self::bootKernel();
        $this->calculator = self::getContainer()->get(CalculateTotalScoreService::class);
        $this->firstUser = new User();
        $this->secondUser = new User();
    }


    public function testCalculateTotalScore(): void
    {
        $this->firstUser->setName('First');
        $this->firstUser->setSurname('Firstovich');
        $this->firstUser->setPhoneNumber('9232295589'); // +10
        $this->firstUser->setEmail('test@gmail.com'); // +10
        $this->firstUser->setEducation('higher'); // +15        
        $this->firstUser->setAgreeTerms(true); // +4

        $firstScore = $this->calculator->calculate($this->firstUser);

        $this->secondUser->setName('Second');
        $this->secondUser->setSurname('Secondovich');
        $this->secondUser->setPhoneNumber('9132295589'); // +3
        $this->secondUser->setEmail('test@other.com'); // +3
        $this->secondUser->setEducation('secondary'); // +5        
        $this->secondUser->setAgreeTerms(false); // 0

        $secondScore = $this->calculator->calculate($this->secondUser);

        $sum = $firstScore + $secondScore; // 50
        $exp = 50;
        
        $this->assertEquals($exp, $sum);
    }
}
