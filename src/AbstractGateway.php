<?php

namespace Muzik\OmnipayEsafe;

use Omnipay\Common\GatewayInterface;
use Omnipay\Common\Helper;

abstract class AbstractGateway implements GatewayInterface
{
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
        return $this;
    }

    public function getParameters()
    {
        return [];
    }
}