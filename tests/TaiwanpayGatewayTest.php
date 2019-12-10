<?php

namespace Test;

use Muzik\OmnipayEsafe\TaiwanpayGateway;
use PHPUnit\Framework\TestCase;

class TaiwanpayGatewayTest extends TestCase
{
    protected TaiwanpayGateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = new TaiwanpayGateway();
    }

    public function test_supports_apis()
    {
        $this->assertFalse($this->gateway->supportsAuthorize());
        $this->assertFalse($this->gateway->supportsCompleteAuthorize());
        $this->assertFalse($this->gateway->supportsCapture());
        $this->assertFalse($this->gateway->supportsPurchase());
        $this->assertTrue($this->gateway->supportsCompletePurchase());
        $this->assertFalse($this->gateway->supportsRefund());
        $this->assertFalse($this->gateway->supportsVoid());
        $this->assertFalse($this->gateway->supportsAcceptNotification());
        $this->assertFalse($this->gateway->supportsCreateCard());
        $this->assertFalse($this->gateway->supportsDeleteCard());
        $this->assertFalse($this->gateway->supportsUpdateCard());
    }
}