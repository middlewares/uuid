<?php

namespace Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Ramsey\Uuid\Uuid as UuidFactory;

class Uuid implements MiddlewareInterface
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
