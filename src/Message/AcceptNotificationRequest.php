<?php

namespace Muzik\OmnipayEsafe\Message;

use Muzik\EsafeSdk\Esafe;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;
use Muzik\EsafeSdk\Exceptions\HandlerException;

class AcceptNotificationRequest implements RequestInterface
{
    /**
     * Store refund response after send() was called.
     *
     * @var ResponseInterface|null
     */
    protected ?ResponseInterface $response = null;

    /**
     * ESafe PHP SDK.
     *
     * @var Esafe
     */
    protected Esafe $sdk;

    /**
     * Handler class name which will be used.
     *
     * @var string
     */
    protected string $handler;

    /**
     * Store parameters.
     *
     * @var array
     */
    protected array $parameters;

    /**
     * Initialize by ESafe PHP SDK.
     *
     * @param Esafe $sdk
     */
    public function __construct(Esafe $sdk)
    {
        $this->sdk = $sdk;
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
     * Bind parameters and setup handler.
     *
     * @param array $parameters
     */
    public function initialize(array $parameters = [])
    {
        $this->handler = $parameters['handler'];
        $this->parameters = $parameters;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * If response exists, return it; otherwise, send a new response.
     *
     * @return RefundResponse|\Omnipay\Common\Message\ResponseInterface|null
     */
    public function getResponse()
    {
        return $this->response ?: $this->send();
    }

    public function isTesting(): bool
    {
        return $this->parameters['testing'] ?? false;
    }

    /**
     * Send request and get response by default parameters
     *
     * @return RefundResponse|\Omnipay\Common\Message\ResponseInterface|null
     */
    public function send()
    {
        return $this->sendData($this->getParameters());
    }

    /**
     * If using custom $data for requesting, can use as `$this->sendData(['foo' => 'bar'])`
     *
     * @param mixed $data
     * @return RefundResponse|\Omnipay\Common\Message\ResponseInterface|null
     */
    public function sendData($data)
    {
        try {
            $handler = $this->sdk->handle($this->handler, $data);

            return ($this->response = new AcceptNotificationResponse($this, $handler));
        } catch (HandlerException $exception) {
            return ($this->response = new AcceptNotificationResponse($this, null, $exception));
        }
    }
}
