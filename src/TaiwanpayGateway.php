<?php

namespace Muzik\OmnipayEsafe;

class TaiwanpayGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Taiwanpay';
    }

    public function completePurchase(array $options = array())
    {
    }
}