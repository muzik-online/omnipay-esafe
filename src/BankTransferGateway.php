<?php

namespace Muzik\OmnipayEsafe;

use Muzik\EsafeSdk\Esafe;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;
use Muzik\OmnipayEsafe\Message\AcceptNotificationRequest;

class BankTransferGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Bank Transfer';
    }

    public function completePurchase(array $options = [])
    {
        $request = new CompletePurchaseRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize(['handler' => Esafe::HANDLER_BANK_TRANSFER_RESULT] + $options);

        return $request;
    }

    public function acceptNotification(array $options = [])
    {
        $request = new AcceptNotificationRequest(new Esafe(['transaction_password' => $this->getApiKey()]));
        $request->initialize(['handler' => Esafe::HANDLER_BANK_TRANSFER] + $options);

        return $request;
    }
}
