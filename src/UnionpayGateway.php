<?php

namespace Muzik\OmnipayEsafe;

use Muzik\OmnipayEsafe\Message\RefundRequest;

class UnionpayGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Unionpay';
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