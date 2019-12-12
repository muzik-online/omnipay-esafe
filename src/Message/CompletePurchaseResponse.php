<?php

namespace Muzik\OmnipayEsafe\Message;

use RuntimeException;
use Muzik\EsafeSdk\Contracts\Handler;
use Omnipay\Common\Message\ResponseInterface;

class CompletePurchaseResponse implements ResponseInterface
{
    protected CompletePurchaseRequest $request;
    protected Handler $handler;
    protected ?RuntimeException $exception = null;

    public function __construct(CompletePurchaseRequest $request, ?Handler $handler = null, RuntimeException $exception = null)
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
        if ($this->exception) {
            return false;
        }

        if ($this->handler && $this->handler->getParameters()['errcode'] === '00') {
            return true;
        }

        return false;
    }

    public function isRedirect()
    {
        return false;
    }

    public function isCancelled()
    {
        return !$this->isSuccessful();
    }

    public function getMessage()
    {
        if ($this->exception) {
            return $this->exception->getMessage();
        }

        if ($this->handler) {
            return $this->handler->getParameters()['errmsg'] ?? null;
        }

        return null;
    }

    public function getCode()
    {
        if ($this->exception) {
            return $this->exception->getCode();
        }

        if ($this->handler) {
            return $this->handler->getParameters()['errcode'] ?? null;
        }

        return null;
    }

    public function getTransactionReference()
    {
        return $this->handler->getTransactionReference();
    }
}
