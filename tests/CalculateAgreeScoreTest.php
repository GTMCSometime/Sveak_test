<?php

namespace App\Tests;

use App\Entity\User;
use App\Services\CalculateAgreeService;
use PHPUnit\Framework\TestCase;

class CalculateAgreeScoreTest extends TestCase
{
    /**
     * @dataProvider agreeTermsDataProvider
     */
    public function testCalculateAgreeTerms(bool $agreeTermsValue, int $expectedScore): void
    {
        $userMock = $this->createMock(User::class);
        
        $userMock->method('getAgreeTerms')->willReturn($agreeTermsValue);

        $service = new CalculateAgreeService();

        $actualScore = $service->calculate($userMock);

        $this->assertSame(
            $expectedScore,
            $actualScore,
            "Expected score $expectedScore for agreeTerms '$agreeTermsValue'"
        );
    }

    
    public function agreeTermsDataProvider(): array
    {
        return [
            'The user has given agree' => [true, 4],
            'The user has given`t agree' => [false, 0],
        ];
    }
}
