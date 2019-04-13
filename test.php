<?php
/**
 * User: Viral
 * Date: 4/12/2019
 */

require_once("src/Helcim.php");

$accountId = 0;
$apiToken = "abc";

$helcim = new Helcim($accountId, "$apiToken", array(
    'testMode' => true
));

$customer = $helcim->customers->fetchCustomer(array(
    'customerCode' => 'CST1001'
));

print_r($customer->getData());