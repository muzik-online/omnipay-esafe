<?php

namespace Muzik\OmnipayEsafe\Message;

use Muzik\EsafeSdk\Esafe;
use Omnipay\Common\Message\RequestInterface;
use Muzik\EsafeSdk\Exceptions\RefundException;

class RefundRequest implements RequestInterface
{
    /**
     * Store refund response after send() was called.
     *
     * @var RefundResponse|null
     */
    protected ?RefundResponse $response = null;

    /**
     * Store parameters.
     *
     * @var array
     */
    protected array $parameters;

    /**
     * ESafe PHP SDK.
     *
     * @var Esafe
     */
    protected Esafe $sdk;

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
     * Bind parameters.
     *
     * @param array $parameters
     */
    public function initialize(array $parameters = [])
    {
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
     * Send request and get response.
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
            $this->sdk->refund($data, $this->isTesting())->send();

            return ($this->response = new RefundResponse($this));
        } catch (RefundException $exception) {
            return ($this->response = new RefundResponse($this, $exception));
        }
    }
}
