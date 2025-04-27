<?php

namespace App\Tests;

use App\Entity\User;
use App\Services\CalculateScoreService;
use PHPUnit\Framework\TestCase;

class TotalScoreTest extends TestCase
{
    public function testSomething(): void
    {
        $firstUser = new User();
        $firstUser->setName('First');
        $firstUser->setSurname('Firstovich');
        $firstUser->setPhoneNumber('9232295589'); // +10
        $firstUser->setEmail('test@gmail.com'); // +10
        $firstUser->setEducation('higher'); // +15        
        $firstUser->setAgreeTerms(true); // +4
        $firstScore = new CalculateScoreService()->calculate($firstUser);

        $secondUser = new User();
        $secondUser->setName('Second');
        $secondUser->setSurname('Secondovich');
        $secondUser->setPhoneNumber('9132295589'); // +3
        $secondUser->setEmail('test@other.com'); // +3
        $secondUser->setEducation('secondary'); // +5        
        $secondUser->setAgreeTerms(false); // 0
        $secondScore = new CalculateScoreService()->calculate($secondUser);

        $sum = $firstScore + $secondScore; // 50
        $exp = 50;
        $this->assertEquals($exp, $sum);
    }
}
