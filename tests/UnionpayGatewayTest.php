<?php

namespace Test;

use Muzik\OmnipayEsafe\UnionpayGateway;
use PHPUnit\Framework\TestCase;

class UnionpayGatewayTest extends TestCase
{
    protected UnionpayGateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = new UnionpayGateway();
    }

    public function test_supports_apis()
    {
        $this->assertFalse($this->gateway->supportsAuthorize());
        $this->assertFalse($this->gateway->supportsCompleteAuthorize());
        $this->assertFalse($this->gateway->supportsCapture());
        $this->assertFalse($this->gateway->supportsPurchase());
        $this->assertTrue($this->gateway->supportsCompletePurchase());
        $this->assertTrue($this->gateway->supportsRefund());
        $this->assertFalse($this->gateway->supportsVoid());
        $this->assertFalse($this->gateway->supportsAcceptNotification());
        $this->assertFalse($this->gateway->supportsCreateCard());
        $this->assertFalse($this->gateway->supportsDeleteCard());
        $this->assertFalse($this->gateway->supportsUpdateCard());
    }
}