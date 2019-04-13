PHP library Helcim Commerce API
=============
This library provides convenient wrapper functions for Helcim Commerce REST API. The API is documented here.

Requirements
--------
PHP 5.4.0

Example
--------

## Test Connection
```php
include('./Helcim.php');

$accountId = (int)"YOUR-ACCOUNT-ID";
$apiToken = "YOUR-API-TOKEN";

$helcim = new Helcim($accountId, $apiToken, array(
    'testMode' => true,
    'debug' => true
));

print_r($helcim->misc->testConnection()->getData());
```

## Process Purchase
```php
include('./Helcim.php');

$accountId = (int)"YOUR-ACCOUNT-ID";
$apiToken = "YOUR-API-TOKEN";

$helcim = new Helcim($accountId, $apiToken, array(
    'testMode' => true,
    'debug' => true
));

$amount = 100;
$cardNumber = 5454545454545454;
$cardExpiry = 0125;
$cardCVV = 100;

print_r($helcim->payments->card->purchase($amount, $cardNumber, $cardExpiry, $cardCVV)->getData());
```

## Fetch Customer
```php
include('./Helcim.php');

$accountId = (int)"YOUR-ACCOUNT-ID";
$apiToken = "YOUR-API-TOKEN";

$helcim = new Helcim($accountId, $apiToken, array(
    'testMode' => true,
    'debug' => true
));

$customerCode = 'CST1001';

print_r($helcim->customers->fetchCustomer($customerCode)->getData());
```

## View Order
```php
include('./Helcim.php');

$accountId = (int)"YOUR-ACCOUNT-ID";
$apiToken = "YOUR-API-TOKEN";

$helcim = new Helcim($accountId, $apiToken, array(
    'testMode' => true,
    'debug' => true
));

$orderNumber = 'INV1001';

print_r($helcim->customers->viewOrder($orderNumber)->getData());
```

## Helcim Commerce API Documentation
Helcim did a amazing job documenting there api. You can find all the documentation here and I also provided references to all the actions/transactionTypes in the comments of the code.
https://www.helcim.com/support/article/625-helcim-commerce-api-api-overview/
