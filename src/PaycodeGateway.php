<?php

namespace Muzik\OmnipayEsafe;

use Muzik\EsafeSdk\Esafe;
use Muzik\OmnipayEsafe\Message\AcceptNotificationRequest;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;

class PaycodeGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Paycode';
    }

    public function completePurchase(array $options = [])
    {
        $request = new CompletePurchaseRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize(['handler' => Esafe::HANDLER_PAYCODE_RESULT] + $options);

        return $request;
    }

    public function acceptNotification(array $options = [])
    {
        $request = new AcceptNotificationRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize(['handler' => Esafe::HANDLER_PAYCODE] + $options);

        return $request;
    }
}
