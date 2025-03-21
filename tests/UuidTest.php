<?php

declare(strict_types = 1);

namespace Middlewares\Tests;

use Middlewares\Utils\Dispatcher;
use Middlewares\Uuid;
use PHPUnit\Framework\TestCase;

class UuidTest extends TestCase
{
    /**
     * phpunit 8 support
     */
    public static function assertMatchesRegularExpression(string $pattern, string $string, string $message = ''): void
    {
        /* @phpstan-ignore function.alreadyNarrowedType */
        if (method_exists(parent::class, 'assertMatchesRegularExpression')) {
            parent::assertMatchesRegularExpression($pattern, $string, $message);

            return;
        }

        self::assertRegExp($pattern, $string, $message);
    }

    public function testUuid(): void
    {
        $response = Dispatcher::run([
            new Uuid(),
            function ($request) {
                echo $request->getHeaderLine('X-Uuid');
            },
        ]);

        self::assertMatchesRegularExpression(
            '/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/',
            $response->getHeaderLine('X-Uuid')
        );
        self::assertEquals($response->getHeaderLine('X-Uuid'), (string) $response->getBody());
    }

    public function testHeader(): void
    {
        $response = Dispatcher::run([
            (new Uuid())->header('X-Request-Id'),
            function ($request) {
                echo $request->getHeaderLine('X-Request-Id');
            },
        ]);

        self::assertMatchesRegularExpression(
            '/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/',
            $response->getHeaderLine('X-Request-Id')
        );
        self::assertEquals($response->getHeaderLine('X-Request-Id'), (string) $response->getBody());
    }
}
