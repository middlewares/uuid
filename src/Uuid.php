<?php

namespace Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Interop\Http\Middleware\ServerMiddlewareInterface;
use Interop\Http\Middleware\DelegateInterface;
use Ramsey\Uuid\Uuid as UuidFactory;

class Uuid implements ServerMiddlewareInterface
{
    const HEADER = 'X-Uuid';

    /**
     * Process a request and return a response.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface      $delegate
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $uuid = (string) UuidFactory::uuid4();

        return $delegate->process($request->withHeader(self::HEADER, $uuid))
            ->withHeader(self::HEADER, $uuid);
    }
}
