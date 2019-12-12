<?php

namespace Muzik\OmnipayEsafe\Message;

use RuntimeException;
use Muzik\EsafeSdk\Contracts\Handler;
use Omnipay\Common\Message\ResponseInterface;

class AcceptNotificationResponse implements ResponseInterface
{
    protected AcceptNotificationRequest $request;
    protected Handler $handler;
    protected ?RuntimeException $exception = null;

    public function __construct(AcceptNotificationRequest $request, ?Handler $handler = null, RuntimeException $exception = null)
    {
        $this->request = $request;
        if ($handler) {
            $this->handler = $handler;
        }
        $this->exception = $exception;
    }

    public function getData()
    {
        return $this->handler
            ? $this->handler->getParameters()
            : $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function isSuccessful()
    {
        return $this->exception === null;
    }

    public function isRedirect()
    {
        return false;
    }

    public function isCancelled()
    {
        return false;
    }

    public function getMessage()
    {
        return $this->exception
            ? $this->exception->getMessage()
            : null;
    }

    public function getCode()
    {
        return $this->exception
            ? $this->exception->getCode()
            : null;
    }

    public function getTransactionReference()
    {
        return $this->handler
            ? $this->handler->getTransactionReference()
            : null;
    }
}
