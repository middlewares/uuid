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

        $this->assertInstanceOf('Psr\\Http\\Message\\ResponseInterface', $response);
        $this->assertRegExp(
            '/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/',
            $response->getHeaderLine('X-Uuid')
        );
        $this->assertEquals($response->getHeaderLine('X-Uuid'), (string) $response->getBody());
    }
}
