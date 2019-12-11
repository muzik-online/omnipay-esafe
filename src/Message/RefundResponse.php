<?php

namespace Muzik\OmnipayEsafe\Message;

use RuntimeException;
use Omnipay\Common\Message\ResponseInterface;

class RefundResponse implements ResponseInterface
{
    protected RefundRequest $request;
    protected ?RuntimeException $exception = null;

    public function __construct(RefundRequest $request, RuntimeException $exception = null)
    {
        $this->request = $request;
        $this->exception = $exception;
    }

    public function getData()
    {
        return null;
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
        return $this->exception !== null;
    }

    public function getMessage()
    {
        return $this->exception
            ? $this->exception->getMessage()
            : 'E0';
    }

    public function getCode()
    {
        return $this->exception
            ? $this->exception->getCode()
            : 'E0';
    }

    public function getTransactionReference()
    {
        return null;
    }
}
