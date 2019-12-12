<?php

namespace Test;

use Muzik\OmnipayEsafe\BankTransferGateway;
use Muzik\OmnipayEsafe\BarcodeGateway;
use Muzik\OmnipayEsafe\CashOnDeliveryGateway;
use Muzik\OmnipayEsafe\CreditCardGateway;
use Muzik\OmnipayEsafe\EsafeGatewayFactory;
use Muzik\OmnipayEsafe\PaycodeGateway;
use Muzik\OmnipayEsafe\TaiwanpayGateway;
use Muzik\OmnipayEsafe\UnionpayGateway;
use Muzik\OmnipayEsafe\WebAtmGateway;
use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;

class EsafeGatewayFactoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Omnipay::setFactory(new EsafeGatewayFactory());
    }

    public function test_construct_gateways()
    {
        $this->assertInstanceOf(BankTransferGateway::class, Omnipay::create(BankTransferGateway::class));
        $this->assertInstanceOf(BarcodeGateway::class, Omnipay::create(BarcodeGateway::class));
        $this->assertInstanceOf(CashOnDeliveryGateway::class, Omnipay::create(CashOnDeliveryGateway::class));
        $this->assertInstanceOf(CreditCardGateway::class, Omnipay::create(CreditCardGateway::class));
        $this->assertInstanceOf(PaycodeGateway::class, Omnipay::create(PaycodeGateway::class));
        $this->assertInstanceOf(TaiwanpayGateway::class, Omnipay::create(TaiwanpayGateway::class));
        $this->assertInstanceOf(UnionpayGateway::class, Omnipay::create(UnionpayGateway::class));
        $this->assertInstanceOf(WebAtmGateway::class, Omnipay::create(WebAtmGateway::class));
    }
}