# js-crypto
php class to encryption and decryption

# Requirements
js-crypto Requires PHP >= 7.0

# Installation
## Using Composer
You can install this package using composer. Add this package to your composer.json:

```
"require": {
	"jsoltani/js-crypto": "dev-master"
}
```

or if you prefer command line, change directory to project root and:

```
php composer.phar require "jsoltani/js-crypto":"dev-master"
```

# Example Usage
```
jsCrypto::setKey('aaaaaadassfvsdgsfgregdfgb');
jsCrypto::setMethod('AES-128-CFB8');
$data = jsCrypto::encrypt("Test Crypt");

echo "Encrypt: $data <br>";
echo "Decrypt: " . jsCrypto::decrypt($data);
```
