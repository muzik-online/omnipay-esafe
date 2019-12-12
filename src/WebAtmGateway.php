<?php

namespace Muzik\OmnipayEsafe;

use Muzik\EsafeSdk\Esafe;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;

class WebAtmGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Web ATM';
    }

    public function completePurchase(array $options = [])
    {
        $request = new CompletePurchaseRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize(['handler' => Esafe::HANDLER_WEB_ATM] + $options);

        return $request;
    }
}
