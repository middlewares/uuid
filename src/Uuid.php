<?php
declare(strict_types = 1);

namespace Middlewares;

use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ramsey\Uuid\Uuid as UuidFactory;

class Uuid implements MiddlewareInterface
{
    private $header = 'X-Uuid';

    /**
     * Configure the header name to store the identifier
     */
    public function header(string $header): self
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Process a request and return a response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uuid = (string) UuidFactory::uuid4();

        return $handler->handle($request->withHeader($this->header, $uuid))
            ->withHeader($this->header, $uuid);
    }
}
