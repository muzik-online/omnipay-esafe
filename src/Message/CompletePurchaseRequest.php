<?php

namespace Muzik\OmnipayEsafe\Message;

use Muzik\EsafeSdk\Contracts\Handler;
use Muzik\EsafeSdk\Esafe;
use Muzik\EsafeSdk\Exceptions\HandlerException;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class CompletePurchaseRequest implements RequestInterface
{
    protected ?ResponseInterface $response = null;

    protected Esafe $sdk;

    protected string $handler;

    protected array $parameters;

    public function __construct(Esafe $sdk)
    {
        $this->sdk = $sdk;
    }

    public function getData()
    {
        return $this;
    }

    public function initialize(array $parameters = array())
    {
        $this->handler = $parameters['handler'];
        $this->parameters = $parameters;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getResponse()
    {
        return $this->response ?: $this->send();
    }

    public function isTesting(): bool
    {
        return $this->parameters['testing'] ?? false;
    }

    public function send()
    {
        return $this->sendData($this->getParameters());
    }

    public function sendData($data)
    {
        try {
            $handler = $this->sdk->handle($this->handler, $this->getParameters());

            $response = new CompletePurchaseResponse($this, $handler);
        } catch (HandlerException $exception) {
            $response = new CompletePurchaseResponse($this, null, $exception);
        } finally {
            return $response;
        }
    }
}