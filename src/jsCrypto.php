<?php
/**
 * jsCrypto - The main class
 *
 * @author    javad soltani <j.soltani.it@gmail.com>
 * @license   http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 */
class jsCrypto {

    public static $KEY    = "key test";
    public static $METHOD = 'AES-128-CFB8';

    /**
     * create
     * for create hash with algorithm
     *
     * @param string $algo
     * @param string $data
     * @param string $salt
     *
     * @return string
     */
    public static function create( string $algo, string $data, string $salt) : string {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        return hash_final($context);
    }

    /**
     * encrypt
     * for encrypt data
     *
     * @param string $data
     *
     * @return string
     */
    public static function encrypt( string $data ) : string {
        $encryption_key = self::$KEY;
        $key = pack('H*', $encryption_key);
        $method = self::$METHOD;
        $iv = substr( hash( 'sha256', $encryption_key ), 0, 16 );

        $encoded =  self::jsBase64Encode(openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv));

        return $encoded;
    }

    /**
     * decrypt
     * for decrypt data
     *
     * @param string $data
     *
     * @return string
     */
    public static function decrypt( string $data ) : string {
        $encryption_key = self::$KEY;
        $key = pack('H*', $encryption_key);
        $method = self::$METHOD;
        $iv = substr( hash( 'sha256', $encryption_key ), 0, 16 );

        $decrypted =  openssl_decrypt(self::jsBase64Decode($data), $method, $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);
        return $decrypted;
    }

    /**
     * set key for encryption key
     * @param string $key
     */
    public static function setKey($key = ''){
        self::$KEY = $key;
    }

    /**
     * get key for encryption key
     * @return string
     */
    public static function getKey(){
        return self::$KEY;
    }

    /**
     * set method for encryption
     * @param string $method
     */
    public static function setMethod($method = 'AES-128-CFB8'){
        self::$METHOD = $method;
    }

    /**
     * get method for encryption
     * @return string
     */
    public static function getMethod(){
        return self::$METHOD;
    }

    /**
     * jsBase64Encode
     * for encode base64 data
     *
     * @param string $data
     *
     * @return string
     */
    public static function jsBase64Encode( string $data ) : string {
        return rtrim(str_replace(array('+', '/'), array('-', '_'), base64_encode($data)), '=');
    }

    /**
     * jsBase64Decode
     * for decode base64 data
     *
     * @param string $data
     *
     * @return string
     */
    public static function jsBase64Decode( string $data ) : string {
        return base64_decode(str_replace(array('-', '_'), array('+', '/'), $data));
    }
}