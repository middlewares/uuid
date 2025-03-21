<?php
declare(strict_types = 1);

namespace Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid as UuidFactory;

class Uuid implements MiddlewareInterface
{
    /** @var string */
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
        $uuid = UuidFactory::uuid4()->toString();

        return $handler->handle($request->withHeader($this->header, $uuid))
            ->withHeader($this->header, $uuid);
    }
}
