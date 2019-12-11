<?php

namespace Muzik\OmnipayEsafe;

class BankTransferGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Bank Transfer';
    }

    public function completePurchase(array $options = [])
    {
    }

    public function acceptNotification(array $options = [])
    {
    }
}
