<?php

namespace Muzik\OmnipayEsafe\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class RefundRequest implements RequestInterface
{
    protected ?RefundResponse $response = null;

    protected array $parameters;

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

    public function send()
    {
        return $this->sendData($this->getParameters());
    }

    public function sendData($data)
    {
        // TODO: Implement sendData() method.
        $this->response = new RefundResponse();
        return $this->response;
    }
}