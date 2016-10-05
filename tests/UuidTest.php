<?php

namespace Middlewares\Tests;

use Middlewares\Uuid;
use Zend\Diactoros\Request;
use Zend\Diactoros\Response;
use mindplay\middleman\Dispatcher;

class UuidTest extends \PHPUnit_Framework_TestCase
{
    public function testUuid()
    {
        $response = (new Dispatcher([
            new Uuid(),
            function ($request) {
                $response = new Response();
                $response->getBody()->write($request->getHeaderLine('X-Uuid'));

                return $response;
            },
        ]))->dispatch(new Request());

        $this->assertInstanceOf('Psr\\Http\\Message\\ResponseInterface', $response);
        $this->assertRegExp(
            '/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/',
            $response->getHeaderLine('X-Uuid')
        );
        $this->assertEquals($response->getHeaderLine('X-Uuid'), (string) $response->getBody());
    }
}
