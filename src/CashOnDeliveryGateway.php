<?php

namespace Muzik\OmnipayEsafe;

class CashOnDeliveryGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Cash On Delivery';
    }
}