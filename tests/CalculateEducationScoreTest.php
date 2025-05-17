<?php

namespace App\Tests;

use App\Entity\User;
use App\Services\CalculateEducationService;
use PHPUnit\Framework\TestCase;

class CalculateEducationScoreTest extends TestCase
{
        /**
     * @dataProvider educationDataProvider
     */
    public function testCalculateEducation(string $educationValue, int $expectedScore): void
    {
        $userMock = $this->createMock(User::class);
        
        $userMock->method('getEducation')->willReturn($educationValue);

        $service = new CalculateEducationService();

        $actualScore = $service->calculate($userMock);

        $this->assertSame(
            $expectedScore,
            $actualScore,
            "Expected score $expectedScore for education type '$educationValue'"
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
