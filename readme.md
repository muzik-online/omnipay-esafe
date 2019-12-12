# Omnipay: Esafe
![](https://github.com/muzik-online/omnipay-esafe/workflows/Test/badge.svg)

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

First of all, should create gateway instance

```php
<?php

use Omnipay\Omnipay;
use Muzik\OmnipayEsafe\EsafeGatewayFactory;
use Muzik\OmnipayEsafe\CreditCardGateway;

Omnipay::setFactory(new EsafeGatewayFactory());
$gateway = Omnipay::create(CreditCardGateway::class);
// When using testing endpoint for refunding, please use `$gateway->setTestMode(true)`
$gateway->setTestMode(true);

$gateway->setApiKey('abcd5888');
// The following two methods also can setting transaction password（API KEY） 
// $gateway->initialize(['api_key' => 'abcd5888']);
// $gateway->initialize(['transaction_password' => 'abcd5888']);
```

### Credit Card

#### Payment

```php
<?php

$response = $gateway->completePurchase([
    // POST from esafe.com.tw webhook
])->send();

if ($response->isSuccessful()) {
    // 付款成功
    vardump($response->getData()); // 取得紅陽的回傳資料
} else {
    // 付款失敗
    var_dump($response);
}
```

#### Refund

```php
<?php

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

```php
<?php

$response = $gateway->completePurchase([
    // POST from esafe.com.tw webhook
])->send();

if ($response->isSuccessful()) {
    // 付款成功
    vardump($response->getData()); // 取得紅陽的回傳資料
} else {
    // 付款失敗
    var_dump($response);
}
```

#### Refund


```php
<?php

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
    - `completePurchase(array $options = []): CompletePurchaseRequest`
    - `acceptNotification(array $options = []): AcceptNotificationRequest`
- Barcode
    - `completePurchase(array $options = []): CompletePurchaseRequest`
    - `acceptNotification(array $options = []): AcceptNotificationRequest`
- CashOnDelivery
    - `completePurchase(array $options = []): CompletePurchaseRequest`
    - `acceptNotification(array $options = []): AcceptNotificationRequest`
- CreditCard
    - `completePurchase(array $options = []): CompletePurchaseRequest`
    - `refund(array $options = []): RefundRequest`
- Paycode
    - `completePurchase(array $options = []): CompletePurchaseRequest`
    - `acceptNotification(array $options = []): AcceptNotificationRequest`
- Taiwanpay
    - `completePurchase(array $options = []): CompletePurchaseRequest`
- Unionpay
    - `completePurchase(array $options = []): CompletePurchaseRequest`
    - `refund(array $options = []): RefundRequest`
- WebAtm
    - `completePurchase(array $options = []): CompletePurchaseRequest`

## License

This library is under [MIT](https://opensource.org/licenses/MIT) license.