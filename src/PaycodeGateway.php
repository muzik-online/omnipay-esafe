<?php

namespace Muzik\OmnipayEsafe;

class PaycodeGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Paycode';
    }
}