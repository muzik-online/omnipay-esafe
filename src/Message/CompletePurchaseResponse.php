<?php

namespace Muzik\OmnipayEsafe\Message;

use RuntimeException;
use Muzik\EsafeSdk\Contracts\Handler;
use Omnipay\Common\Message\ResponseInterface;

class CompletePurchaseResponse implements ResponseInterface
{
    /**
     * Original request.
     *
     * @var CompletePurchaseRequest
     */
    protected CompletePurchaseRequest $request;

    /**
     * The handler for payments from SDK.
     *
     * @var Handler|null
     */
    protected Handler $handler;

    /**
     *  When exception has been thrown, payment failed.
     *
     * @var RuntimeException|null
     */
    protected ?RuntimeException $exception = null;

    /**
     * CompletePurchaseResponse constructor.
     *
     * @param CompletePurchaseRequest $request
     * @param Handler|null $handler
     * @param RuntimeException|null $exception
     */
    public function __construct(CompletePurchaseRequest $request, ?Handler $handler = null, RuntimeException $exception = null)
    {
        $this->request = $request;
        if ($handler) {
            $this->handler = $handler;
        }
        $this->exception = $exception;
    }

    /**
     * When response exists returning response parameters, or returning this object.
     *
     * @return array|mixed|CompletePurchaseResponse
     */
    public function getData()
    {
        return $this->handler
            ? $this->handler->getParameters()
            : $this;
    }

    /**
     * Original request.
     *
     * @return CompletePurchaseRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * When exception has been thrown, it failed.
     * When response errcode is not "00", it failed.
     *
     * @return bool
     */
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

    /**
     * When exception exists, return exception message.
     * When response exists, try to get errmsg from esafe.
     *
     * @return mixed|string|null
     */
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

    /**
     * When exception exists, return exception code.
     * When response exists, try to get errcode from esafe.
     *
     * @return int|mixed|string|null
     */
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

    /**
     * Get buysafeno from esafe response.
     *
     * @return string|null
     */
    public function getTransactionReference()
    {
        return $this->handler->getTransactionReference();
    }
}
