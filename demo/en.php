<?php
// Load the image data from file

// Generate a new RSA key pair
$private_key = openssl_pkey_new(array(
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
));

$image_data = file_get_contents("img1.jpeg");
// Extract the public key from the key pair
$public_key = openssl_pkey_get_details($private_key)["key"];

// Encrypt the image data with the public key
$ciphertext = "";
openssl_public_encrypt($image_data, $ciphertext, $public_key);

// Save the encrypted image data to file
file_put_contents("aaaa_encrypted_image.bin", $ciphertext);

// Optionally, you can also save the public and private keys to file
file_put_contents("public_key.pem", $public_key);
$private_key_string = '';
openssl_pkey_export($private_key, $private_key_string);
file_put_contents("private_key.pem", $private_key_string);

// Load the encrypted image data from file
$ciphertext = file_get_contents("aaaa_encrypted_image.bin");

// Load the private key from file
$private_key = openssl_pkey_get_private(file_get_contents("private_key.pem"));

// Decrypt the ciphertext with the private key
$plaintext = "";
openssl_private_decrypt($ciphertext, $plaintext, $private_key);

// Save the decrypted image data to file
file_put_contents("aaaa_decrypted_image.png", $plaintext);

?>
