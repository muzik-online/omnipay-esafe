<?php

namespace Muzik\OmnipayEsafe\Message;

use RuntimeException;
use Omnipay\Common\Message\ResponseInterface;

class RefundResponse implements ResponseInterface
{
    /**
     * Original request which was sent.
     *
     * @var RefundRequest
     */
    protected RefundRequest $request;

    /**
     * When exception has been thrown, refund failed.
     *
     * @var RuntimeException|null
     */
    protected ?RuntimeException $exception = null;

    public function __construct(RefundRequest $request, RuntimeException $exception = null)
    {
        $this->request = $request;
        $this->exception = $exception;
    }

    /**
     * Get current request data, it can use as `var_dump($this->getData())`
     *
     * @return $this|mixed
     */
    public function getData()
    {
        return $this;
    }

    /**
     * Get original request.
     *
     * @return RefundRequest|\Omnipay\Common\Message\RequestInterface
     */
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
