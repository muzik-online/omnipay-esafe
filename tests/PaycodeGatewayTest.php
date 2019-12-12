<?php

namespace Test;

use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;
use PHPUnit\Framework\TestCase;
use Muzik\OmnipayEsafe\PaycodeGateway;

class PaycodeGatewayTest extends TestCase
{
    protected PaycodeGateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = new PaycodeGateway();
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
        $this->assertTrue($this->gateway->supportsAcceptNotification());
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

    public function test_complete_purchase()
    {
        $this->gateway->setApiKey('abcd5888');
        $request = $this->gateway->completePurchase([
            'buysafeno' => '2400009912300000019',
            'web' => 'S1103020010',
            'Td' => '',
            'MN' => '1000',
            'Name' => 'V****** **i',
            'note1' => '',
            'note2' => '',
            'UserNo' => '',
            'PayDate' => '20200101',
            'PayType' => '5',
            'PayAgency' => '',
            'PayAgencyName' => '',
            'PayAgencyTel' => '',
            'PayAgencyAddress' => '',
            'errcode' => '00',
            'CargoNo' => '',
            'StoreID' => '',
            'StoreName' => '',
            'InvoiceNo' => '',
            'ChkValue' => '6E0ED343525CDCBE678BB1103054CBA25E634282',
        ]);

        $this->assertInstanceOf(CompletePurchaseRequest::class, $request);
    }
}
