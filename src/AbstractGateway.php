<?php

namespace Muzik\OmnipayEsafe;

use Omnipay\Common\Helper;
use Omnipay\Common\GatewayInterface;
use Muzik\OmnipayEsafe\Traits\SupportsChecker;

abstract class AbstractGateway implements GatewayInterface
{
    use SupportsChecker;

    protected string $apiKey = '';

    /**
     * Get the short name of the Gateway
     *
     * @return string
     */
    public function getShortName()
    {
        return Helper::getGatewayShortName(get_class($this));
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [];
    }

    public function initialize(array $parameters = [])
    {
        $this->apiKey = $parameters['api_key'] ?? $parameters['transaction_password'] ?? '';

        return $this;
    }

    public function getParameters()
    {
        return [];
    }

    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
