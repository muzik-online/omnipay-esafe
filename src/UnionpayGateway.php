<?php

namespace Muzik\OmnipayEsafe;

use Muzik\EsafeSdk\Esafe;
use Muzik\OmnipayEsafe\Message\RefundRequest;

class UnionpayGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Unionpay';
    }

    public function refund(array $options = array())
    {
        $request = new RefundRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize($options);

        return $request;
    }

    public function completePurchase(array $options = array())
    {
    }
}