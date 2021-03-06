<?php

declare(strict_types=1);

namespace Lit\Core;

use Lit\Core\Interfaces\ViewInterface;
use Lit\Nimo\AbstractHandler;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractAction extends AbstractHandler
{
    /**
     * @var ResponseFactoryInterface
     */
    protected $responseFactory;

    /**
     * @param ResponseInterface $response
     * @throws ThrowableResponse
     */
    protected static function throwResponse(ResponseInterface $response): void
    {
        throw ThrowableResponse::of($response);
    }

    /**
     * @param ViewInterface $view
     * @return ViewInterface
     */
    protected function attachView(ViewInterface $view)
    {
        $view->setResponse($this->responseFactory->createResponse());

        return $view;
    }

    protected function json(): JsonView
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->attachView(new JsonView());
    }
}
