<?php

namespace Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Interop\Http\Middleware\MiddlewareInterface;
use Interop\Http\Middleware\DelegateInterface;
use Ramsey\Uuid\Uuid as UuidFactory;

class Uuid implements MiddlewareInterface
{
    const HEADER = 'X-Uuid';

    /**
     * Process a request and return a response.
     *
     * @param RequestInterface  $request
     * @param DelegateInterface $delegate
     *
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, DelegateInterface $delegate)
    {
        $uuid = (string) UuidFactory::uuid4();

        return $delegate->process($request->withHeader(self::HEADER, $uuid))
            ->withHeader(self::HEADER, $uuid);
    }
}
