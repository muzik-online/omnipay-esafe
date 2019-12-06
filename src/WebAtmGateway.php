<?php

namespace Muzik\OmnipayEsafe;

class WebAtmGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Web ATM';
    }

    public function completePurchase(array $options = array())
    {
    }
}