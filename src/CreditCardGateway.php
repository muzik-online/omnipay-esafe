<?php

namespace Muzik\OmnipayEsafe;

use GuzzleHttp\Psr7\ServerRequest;
use Muzik\EsafeSdk\Contracts\Handler;
use Muzik\EsafeSdk\Esafe;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;
use Muzik\OmnipayEsafe\Message\RefundRequest;

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
        $request->initialize(['driver' => Esafe::HANDLER_CREDIT_CARD] + (array) ServerRequest::fromGlobals()->getParsedBody());

        return $request;
    }
}
