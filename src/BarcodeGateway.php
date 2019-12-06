<?php

namespace Muzik\OmnipayEsafe;

class BarcodeGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Barcode';
    }
}