<?php

namespace Muzik\OmnipayEsafe;

use Muzik\EsafeSdk\Esafe;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;

class CashOnDeliveryGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Cash On Delivery';
    }

    public function completePurchase(array $options = [])
    {
        $request = new CompletePurchaseRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize(['handler' => Esafe::HANDLER_CASH_ON_DELIVERY_RESULT] + $options);

        return $request;
    }

    public function acceptNotification(array $options = [])
    {
    }
}
