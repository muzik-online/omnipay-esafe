<?php

namespace Muzik\OmnipayEsafe;

use Muzik\EsafeSdk\Esafe;
use Muzik\EsafeSdk\Handlers\BankTransferResult;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;

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
    }
}
