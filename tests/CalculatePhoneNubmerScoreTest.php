<?php

namespace App\Tests;

use App\Entity\User;
use App\Services\CalculatePhoneNumberService;
use PHPUnit\Framework\TestCase;

class CalculatePhoneNubmerScoreTest extends TestCase
{
    /**
     * @dataProvider agreeTermsDataProvider
     */
    public function testCalculatePhoneNumber(string $phoneNumberValue, int $expectedScore): void
    {
        $userMock = $this->createMock(User::class);
        
        $userMock->method('getPhoneNumber')->willReturn($phoneNumberValue);

        $service = new CalculatePhoneNumberService();

        $actualScore = $service->calculate($userMock);

        $this->assertSame(
            $expectedScore,
            $actualScore,
            "Expected score $expectedScore for mobile operator '$phoneNumberValue'"
        );
    }

    
    public function agreeTermsDataProvider(): array
    {
        return [
            'The user has mobile operator megafon' => ['923123123', 10],
            'The user has mobile operator beeline' => ['906123123', 5],
            'The user has mobile operator MTS' => ['913123123', 3],
            'The user has another mobile operator' => ['901123123', 1],
        ];
    }
}
