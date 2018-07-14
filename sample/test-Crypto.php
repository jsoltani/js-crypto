<?php

require_once '../vendor/autoload.php';

jsCrypto::setKey('aaaaaadassfvsdgsfgregdfgb');
jsCrypto::setMethod('AES-128-CFB8');
$data = jsCrypto::encrypt("Test Crypt");

echo "Encrypt: $data <br>";
echo "Decrypt: " . jsCrypto::decrypt($data);
