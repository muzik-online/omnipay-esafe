<?php

namespace Muzik\OmnipayEsafe\Message;

use RuntimeException;
use Muzik\EsafeSdk\Contracts\Handler;
use Omnipay\Common\Message\ResponseInterface;

class AcceptNotificationResponse implements ResponseInterface
{
    /**
     * Original request which was sent.
     *
     * @var AcceptNotificationRequest
     */
    protected AcceptNotificationRequest $request;

    /**
     * The handler for payments from SDK.
     *
     * @var Handler|null
     */
    protected Handler $handler;

    /**
     * When exception has been thrown, refund failed.
     *
     * @var RuntimeException|null
     */
    protected ?RuntimeException $exception = null;

    /**
     * AcceptNotificationResponse constructor.
     *
     * @param AcceptNotificationRequest $request
     * @param Handler|null $handler
     * @param RuntimeException|null $exception
     */
    public function __construct(AcceptNotificationRequest $request, ?Handler $handler = null, RuntimeException $exception = null)
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
     * @return array|mixed|AcceptNotificationResponse
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
     * @return AcceptNotificationRequest|\Omnipay\Common\Message\RequestInterface
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

    /**
     * Payment will not be cancelled by response, it always return false.
     *
     * @return bool
     */
    public function isCancelled()
    {
        return false;
    }

    /**
     * Get error message from exception.
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->exception
            ? $this->exception->getMessage()
            : null;
    }

    /**
     * Get error code from exception.
     *
     * @return int|mixed|string|null
     */
    public function getCode()
    {
        return $this->exception
            ? $this->exception->getCode()
            : null;
    }

    /**
     * Get buysafeno from esafe response.
     *
     * @return string|null
     */
    public function getTransactionReference()
    {
        return $this->handler
            ? $this->handler->getTransactionReference()
            : null;
    }
}
