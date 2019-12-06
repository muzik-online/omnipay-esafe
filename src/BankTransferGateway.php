<?php

namespace Muzik\OmnipayEsafe;

class BankTransferGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Bank Transfer';
    }
}