<?php

namespace Muzik\OmnipayEsafe;

use Muzik\EsafeSdk\Esafe;
use Muzik\OmnipayEsafe\Message\RefundRequest;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;

class CreditCardGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Credit Card';
    }

    public function refund(array $options = [])
    {
        $request = new RefundRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize($options);

        return $request;
    }

    public function completePurchase(array $options = [])
    {
        $request = new CompletePurchaseRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize(['handler' => Esafe::HANDLER_CREDIT_CARD] + $options);

        return $request;
    }
}
