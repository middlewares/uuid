<?php

namespace Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Ramsey\Uuid\Uuid as UuidFactory;

class Uuid implements MiddlewareInterface
{
    private $header = 'X-Uuid';

    /**
     * Configure the header name to store the identifier
     *
     * @param string $header
     *
     * @return self
     */
    public function header($header)
    {
        $this->header = $header;

        return $this;
    }

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

        return $delegate->process($request->withHeader($this->header, $uuid))
            ->withHeader($this->header, $uuid);
    }
}
