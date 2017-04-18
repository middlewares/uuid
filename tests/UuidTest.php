<?php

namespace Middlewares\Tests;

use Middlewares\Uuid;
use Middlewares\Utils\Dispatcher;

class UuidTest extends \PHPUnit_Framework_TestCase
{
    public function testUuid()
    {
        $response = Dispatcher::run([
            new Uuid(),
            function ($request) {
                echo $request->getHeaderLine('X-Uuid');
            },
        ]);

        $this->assertRegExp(
            '/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/',
            $response->getHeaderLine('X-Uuid')
        );
        $this->assertEquals($response->getHeaderLine('X-Uuid'), (string) $response->getBody());
    }

    public function testHeader()
    {
        $response = Dispatcher::run([
            (new Uuid())->header('X-Request-Id'),
            function ($request) {
                echo $request->getHeaderLine('X-Request-Id');
            },
        ]);

        $this->assertRegExp(
            '/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/',
            $response->getHeaderLine('X-Request-Id')
        );
        $this->assertEquals($response->getHeaderLine('X-Request-Id'), (string) $response->getBody());
    }
}
