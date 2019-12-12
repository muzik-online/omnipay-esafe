<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Muzik\OmnipayEsafe\UnionpayGateway;
use Muzik\OmnipayEsafe\Message\RefundRequest;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;

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

    public function test_refund()
    {
        $this->gateway->initialize(['api_key' => 'abcd5888']);
        $request = $this->gateway->refund([
            'web' => 'S1103020010',
            'MN' => '1688',
            'buysafeno' => '2400009912300000019',
            'Td' => 'AC9087201',
            'RefundMemo' => 'Foo Bar',
            'ChkValue' => 'ca817f0333f4da7f4ec836b2ac08015a1b76816bc711e3fb42c1708abbb5d081',
        ]);

        $this->assertInstanceOf(RefundRequest::class, $request);
    }

    public function test_complete_request()
    {
        $this->gateway->setApiKey('abcd5888');
        $request = $this->gateway->completePurchase([
            'buysafeno' => '2400009912300000019',
            'web' => 'S1103020010',
            'MN' => '1000',
            'Td' => '',
            'webname' => '英屬維京群島商希幔數位有限公司台灣分公司',
            'Name' => 'V****** **i',
            'note1' => '',
            'note2' => '',
            'ApproveCode' => '',
            'Card_NO' => '',
            'Card_Type' => '1',
            'UserNo' => '',
            'PayDate' => '',
            'PayTime' => '',
            'SendType' => '1',
            'errcode' => '00',
            'errmsg' => '',
            'PayType' => '',
            'PayAgency' => '',
            'PayAgencyMemo' => '',
            'PayAgencyName' => '',
            'PayAgencyTel' => '',
            'PayAgencyAddress' => '',
            'CargoNo' => '',
            'StoreName' => '',
            'StoreID' => '',
            'InvoiceNo' => '',
            'tokenData' => '',
            'ChkValue' => '6E0ED343525CDCBE678BB1103054CBA25E634282',
        ]);

        $this->assertInstanceOf(CompletePurchaseRequest::class, $request);
    }
}
