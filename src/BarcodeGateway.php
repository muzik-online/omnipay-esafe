<?php

namespace Muzik\OmnipayEsafe;

class BarcodeGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Barcode';
    }

    public function completePurchase(array $options = array())
    {
    }

    public function acceptNotification(array $options = array())
    {
    }
}