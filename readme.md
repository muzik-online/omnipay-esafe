# Omnipay: Esafe

ESafe driver for the Omnipay PHP payment processing library.

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment processing library for PHP. This package implements ESafe support for Omnipay.

## Installation

The following gateways are provided by this package:

- BankTransfer（銀行虛擬帳號轉帳）
- Barcode（超商條碼繳費）
- CashOnDelivery（貨到付款）
- CreditCard（信用卡付款）
- Paycode（超商代碼繳費）
- Taiwanpay（Taiwaypay 繳費）
- Unionpay（銀聯卡付款）
- WebAtm（網路 ATM 繳費）

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay) repository.

## Usage

### Credit Card

#### Payment

WIP

#### Refund

```php
<?php
use Omnipay\Omnipay;

$gateway = Omnipay::create('ESafe Credit Card');
$gateway->setApiKey('abcd5888');
// The following two methods also can setting transaction password（API KEY） 
// $gateway->initialize(['api_key' => 'abcd5888']);
// $gateway->initialize(['transaction_password' => 'abcd5888']);

$response = $gateway->refund([
    // 商家代號
    'web' => 'S1103020010',
    // 交易金額
    'MN' => '1688',
    // 紅陽交易編號
    'buysafeno' => '2400009912300000019',
    // 商家訂單編號
    'Td' => 'AC9087201',
    // 退貨原因
    'RefundMemo' => 'Foo Bar', 
])->send();

if ($response->isSuccessful()) {
    // 退款成功
} else {
    // 退款失敗
    var_dump($response->getData());
}
```

- 注意事項
    - `web`, `MN`, `buysafeno`, `Td` 與 `RefundMemo` 都是必填，且**不可**使用空字串
    - 底層 SDK 會根據 API KEY 及相關資訊自動生成 `ChkValue`

### Unionpay Card

#### Payment

#### Refund


```php
<?php
use Omnipay\Omnipay;

$gateway = Omnipay::create('ESafe Unionpay');
$gateway->setApiKey('abcd5888');
// The following two methods also can setting transaction password（API KEY） 
// $gateway->initialize(['api_key' => 'abcd5888']);
// $gateway->initialize(['transaction_password' => 'abcd5888']);

$response = $gateway->refund([
    // 商家代號
    'web' => 'S1103020010',
    // 交易金額
    'MN' => '1688',
    // 紅陽交易編號
    'buysafeno' => '2400009912300000019',
    // 商家訂單編號
    'Td' => 'AC9087201',
    // 退貨原因
    'RefundMemo' => 'Foo Bar', 
])->send();

if ($response->isSuccessful()) {
    // 退款成功
} else {
    // 退款失敗
    var_dump($response->getData());
}
```

- 注意事項
    - `web`, `MN`, `buysafeno`, `Td` 與 `RefundMemo` 都是必填，且**不可**使用空字串
    - 底層 SDK 會根據 API KEY 及相關資訊自動生成 `ChkValue`


## Support APIs

### Description

- All of gateways support `completePurchase()` for handling webhook from esafe.com.tw.
- Only CreditCard and Unionpay gateways support `refund()`
- There are some of async payment gateways support `acceptNotification()`.
    - Get bank transfer information
    - Get Barcode or Paycode

### List

- BankTransfer
    - `completePurchase(array $options = []): RequestInterface`
    - `acceptNotification(array $options = []): RequestInterface`
- Barcode
    - `completePurchase(array $options = []): RequestInterface`
    - `acceptNotification(array $options = []): RequestInterface`
- CashOnDelivery
    - `completePurchase(array $options = []): RequestInterface`
    - `acceptNotification(array $options = []): RequestInterface`
- CreditCard
    - `completePurchase(array $options = []): RequestInterface`
    - `refund(array $options = []): RequestInterface`
- Paycode
    - `completePurchase(array $options = []): RequestInterface`
    - `acceptNotification(array $options = []): RequestInterface`
- Taiwanpay
    - `completePurchase(array $options = []): RequestInterface`
- Unionpay
    - `completePurchase(array $options = []): RequestInterface`
    - `refund(array $options = []): RequestInterface`
- WebAtm
    - `completePurchase(array $options = []): RequestInterface`
