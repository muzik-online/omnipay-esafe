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

### CreditCard

This is an example for synchronize payment gateway.

```php
<?php

use Omnipay\Omnipay;

$gateway = Omnipay::create('ESafe CreditCard');
$gateway->setApiKey('abcd5888'); // ApiKey is transaction password from esafe.com.tw

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals(); // Handle requests from esafe.com.tw webhook.

$response = $gateway->completePurchase((array) $request->getParsedBody())->send(); // Remember `send()` after `completePurchase()`.

echo "{$response->getCode()}: {$response->getMessage()}";

if ($response->isSuccessful()) {
    // Handle successful.
} else {
    // Handle failed.
}
```

### Barcode

This is an example for asynchronize payment gateway.

```php
<?php

use Omnipay\Omnipay;

$gateway = Omnipay::create('ESafe Barcode');
$gateway->setApiKey('abcd5888'); // ApiKey is transaction password from esafe.com.tw

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals(); // Handle requests from esafe.com.tw webhook.

$response = $gateway->acceptNotification((array) $request->getParsedBody())->send(); // Remember `send()` after `acceptNotification()`

if ($response->isSuccessful()) {
    // print barcode to customer.
    var_dump($response);
}
```

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
