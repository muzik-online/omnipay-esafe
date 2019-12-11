<?php

namespace Muzik\OmnipayEsafe;

class CashOnDeliveryGateway extends AbstractGateway
{
    public function getName()
    {
        return 'ESafe Cash On Delivery';
    }

    public function completePurchase(array $options = [])
    {
    }

    public function acceptNotification(array $options = [])
    {
    }
}
