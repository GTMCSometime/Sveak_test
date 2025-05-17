<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CalculateEducationScoreTest extends TestCase
{
        /**
     * @dataProvider educationDataProvider
     */
    public function testCalculateAgreeTerms(string $education, int $expectedScore): void
    {
        $userMock = $this->createMock(User::class);
        
        $userMock->method('education')->willReturn($education);

        $service = new CalculateAgreeService();

        $actualScore = $service->calculate($userMock);

        $this->assertSame(
            $expectedScore, 
            $actualScore,
            "Expected $expectedScore score for agreeTerms = " .
             ($agreeTermsValue ? 'true' : 'false')
        );
    }


    public function educationDataProvider(): array {
        return [
            'The user has higher education' => ['higher', 15],
            'The user has special education' => ['special', 10],
            'The user has secondary education' => ['secondary', 5],
        ];
    }
}
