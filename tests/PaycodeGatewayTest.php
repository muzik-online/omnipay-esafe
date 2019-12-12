<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Muzik\OmnipayEsafe\PaycodeGateway;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;
use Muzik\OmnipayEsafe\Message\AcceptNotificationRequest;

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

    public function test_accept_notification()
    {
        $this->gateway->setApiKey('abcd5888');
        $request = $this->gateway->acceptNotification([
            'buysafeno' =>	'2400009912300000019',
            'web' =>	'S1103020010',
            'MN' =>	'1000',
            'Td' =>	'',
            'webname' =>	'香港商帕格數碼媒體股份有限公司',
            'Name' =>	'V****** **i',
            'note1' =>	'',
            'note2' =>	'',
            'ApproveCode' =>	'',
            'Card_NO' =>	'',
            'Card_Type' =>	'',
            'UserNo' =>	'',
            'PayDate' =>	'',
            'PayTime' =>	'',
            'SendType' =>	'1',
            'errcode' =>	'',
            'errmsg' =>	'',
            'paycode' =>	'LAC90824000098',
            'PayType' =>	'4,5,6,7',
            'PayAgency' =>	'',
            'PayAgencyMemo' =>	'',
            'PayAgencyName' =>	'',
            'PayAgencyTel' =>	'',
            'PayAgencyAddress' =>	'',
            'BarcodeA' =>	'',
            'BarcodeB' =>	'',
            'BarcodeC' =>	'',
            'PostBarcodeA' =>	'',
            'PostBarcodeB' =>	'',
            'PostBarcodeC' =>	'',
            'EntityATM' =>	'',
            'BankCode' =>	'',
            'BankName' =>	'',
            'CargoNo' =>	'',
            'StoreName' =>	'',
            'StoreID' =>	'',
            'InvoiceNo' =>	'',
            'tokenData' =>	'',
            'ChkValue' =>	'9C53A993836A12DD477CF39FBB10E0C4E67323E0',
        ]);

        $this->assertInstanceOf(AcceptNotificationRequest::class, $request);
    }
}
