<?php

namespace Muzik\OmnipayEsafe;

use Muzik\OmnipayEsafe\Message\RefundRequest;

class CreditCardGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Credit Card';
    }

    public function refund(array $options = array())
    {
        $request = new RefundRequest();
        $request->initialize($options);

        return $request;
    }

    public function completePurchase(array $options = array())
    {
    }
}