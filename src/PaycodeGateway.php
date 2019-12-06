<?php

namespace Muzik\OmnipayEsafe;

class PaycodeGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Paycode';
    }

    public function completePurchase(array $options = array())
    {
    }

    public function acceptNotification(array $options = array())
    {
    }
}