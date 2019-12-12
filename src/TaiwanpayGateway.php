<?php

namespace Muzik\OmnipayEsafe;

use Muzik\EsafeSdk\Esafe;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;

class TaiwanpayGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Taiwanpay';
    }

    public function completePurchase(array $options = [])
    {
        $request = new CompletePurchaseRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize(['handler' => Esafe::HANDLER_TAIWAN_PAY] + $options);

        return $request;
    }
}
