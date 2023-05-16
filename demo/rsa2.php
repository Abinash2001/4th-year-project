<?php 
$config = array(
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

// Create the key pair
$res = openssl_pkey_new($config);

// Get the private key
openssl_pkey_export($res, $private_key);

// Get the public key
$public_key = openssl_pkey_get_details($res);
$public_key = $public_key["key"];

$data = 123456;
$ciphertext = "";

echo $public_key;
echo "<br>";
echo "<br>";
echo $private_key;
openssl_public_encrypt($data, $ciphertext, $public_key);
echo "<br>";
echo $ciphertext;
$plaintext = "";
openssl_private_decrypt($ciphertext, $plaintext, $private_key);
echo $plaintext;

?>