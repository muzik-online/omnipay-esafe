<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Muzik\OmnipayEsafe\BankTransferGateway;
use Muzik\OmnipayEsafe\Message\CompletePurchaseRequest;
use Muzik\OmnipayEsafe\Message\AcceptNotificationRequest;

class BankTransferGatewayTest extends TestCase
{
    protected BankTransferGateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = new BankTransferGateway();
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
            'buysafeno' =>	'2400009912300000019',
            'web' =>	'S1103020010',
            'MN' =>	'1000',
            'Td' =>	'',
            'webname' => '英屬維京群島商希幔數位有限公司台灣分公司',
            'Name' =>	'V○○○○○○ ○○i',
            'note1' =>	'',
            'note2' =>	'',
            'ApproveCode' =>	'',
            'Card_NO' =>	'',
            'Card_Type' =>	'',
            'UserNo' =>	'',
            'PayDate' =>	'',
            'PayTime' =>	'',
            'SendType' =>	'1',
            'errcode' =>	'00',
            'errmsg' =>	'交易成功',
            'PayType' =>	'',
            'PayAgency' =>	'',
            'PayAgencyMemo' =>	'',
            'PayAgencyName' =>	'',
            'PayAgencyTel' =>	'',
            'PayAgencyAddress' =>	'',
            'CargoNo' =>	'',
            'StoreName' =>	'',
            'StoreID' =>	'',
            'InvoiceNo' =>	'',
            'tokenData' =>	'',
            'ChkValue' =>	'6E0ED343525CDCBE678BB1103054CBA25E634282',
        ]);

        $this->assertInstanceOf(CompletePurchaseRequest::class, $request);
    }

    public function test_accept_notification()
    {
        $this->gateway->setApiKey('abcd5888');
        $request = $this->gateway->acceptNotification([
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
            'Card_Type' => '',
            'UserNo' => '',
            'PayDate' => '',
            'PayTime' => '',
            'SendType' => '1',
            'errcode' => '',
            'errmsg' => '',
            'paycode' => '',
            'PayType' => '',
            'PayAgency' => '',
            'PayAgencyMemo' => '',
            'PayAgencyName' => '',
            'PayAgencyTel' => '',
            'PayAgencyAddress' => '',
            'BarcodeA' => '',
            'BarcodeB' => '',
            'BarcodeC' => '',
            'PostBarcodeA' => '',
            'PostBarcodeB' => '',
            'PostBarcodeC' => '',
            'EntityATM' => '91708888888888',
            'BankCode' => '8220163',
            'BankName' => '中國信託銀行 敦南分行',
            'CargoNo' => '',
            'StoreName' => '',
            'StoreID' => '',
            'InvoiceNo' => '',
            'tokenData' => '',
            'ChkValue' => 'C0A61FA4830F0B171273B2DC0CCFA2A9BA719A76',
        ]);

        $this->assertInstanceOf(AcceptNotificationRequest::class, $request);
    }
}
