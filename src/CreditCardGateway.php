<?php

namespace Muzik\OmnipayEsafe;

class CreditCardGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Credit Card';
    }
}