<?php

namespace Muzik\OmnipayEsafe;

use Omnipay\Common\GatewayFactory;
use Omnipay\Common\Http\ClientInterface;
use Omnipay\Common\Exception\RuntimeException;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class EsafeGatewayFactory extends GatewayFactory
{
    public function create($class, ClientInterface $httpClient = null, HttpRequest $httpRequest = null)
    {
        if (!class_exists($class)) {
            throw new RuntimeException("Class '$class' not found");
        }

        return new $class();
    }
}
