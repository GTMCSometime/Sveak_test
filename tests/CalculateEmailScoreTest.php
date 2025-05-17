<?php

namespace App\Tests;

use App\Entity\User;
use App\Services\CalculateEmailService;
use PHPUnit\Framework\TestCase;

class CalculateEmailScoreTest extends TestCase
{
        /**
     * @dataProvider emailDataProvider
     */
    public function testCalculateEmail(string $emailValue, int $expectedScore): void
    {
        $userMock = $this->createMock(User::class);
        
        $userMock->method('getEmail')->willReturn($emailValue);

        $service = new CalculateEmailService();

        $actualScore = $service->calculate($userMock);

        $this->assertSame(
            $expectedScore,
            $actualScore,
            "Expected score $expectedScore for email domain '$emailValue'"
        );
    }


    public function emailDataProvider(): array {
        return [
            'The user has @gmail email domain' => ['test@gmail.com', 10],
            'The user has @yandex email domain' => ['test@yandex.com', 8],
            'The user has @mail email domain' => ['test@mail.ru', 6],
            'The user has other email domain' => ['test@other.com', 3],
        ];
    }
}
