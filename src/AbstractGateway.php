<?php

namespace Muzik\OmnipayEsafe;

use Muzik\OmnipayEsafe\Traits\SupportsChecker;
use Omnipay\Common\GatewayInterface;
use Omnipay\Common\Helper;

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

    public function initialize(array $parameters = array())
    {
        $this->apiKey = $parameters['api_key'] ?? '';

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