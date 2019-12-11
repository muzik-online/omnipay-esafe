<?php

namespace Test;

use Muzik\OmnipayEsafe\CreditCardGateway;
use PHPUnit\Framework\TestCase;

class CreditCardGatewayTest extends TestCase
{
    protected CreditCardGateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = new CreditCardGateway();
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

    public function test_set_api_key()
    {
        $this->gateway->setApiKey('abcd5888');

        $this->assertSame('abcd5888', $this->gateway->getApiKey());
    }

    public function test_set_api_key_when_initialize()
    {
        $this->gateway->initialize(['api_key' => 'abcd5888']);

        $this->assertSame('abcd5888', $this->gateway->getApiKey());
    }
}