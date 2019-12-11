<?php

namespace Muzik\OmnipayEsafe\Message;

use Muzik\EsafeSdk\Esafe;
use Muzik\EsafeSdk\Exceptions\RefundException;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class RefundRequest implements RequestInterface
{
    protected ?RefundResponse $response = null;

    protected array $parameters;

    protected Esafe $sdk;

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
            $this->sdk->refund($this->getParameters(), $this->isTesting())->send();

            $this->response = new RefundResponse($this);
        } catch (RefundException $exception) {
            $this->response = new RefundResponse($this, $exception);
        } finally {
            return $this->response;
        }
    }
}