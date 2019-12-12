<?php

namespace Muzik\OmnipayEsafe;

use Muzik\EsafeSdk\Esafe;
use Muzik\OmnipayEsafe\Message\AcceptNotificationRequest;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;

class BarcodeGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Barcode';
    }

    public function completePurchase(array $options = [])
    {
        $request = new CompletePurchaseRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize(['handler' => Esafe::HANDLER_BARCODE_RESULT] + $options);

        return $request;
    }

    public function acceptNotification(array $options = [])
    {
        $request = new AcceptNotificationRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize(['handler' => Esafe::HANDLER_BARCODE] + $options);

        return $request;
    }
}
