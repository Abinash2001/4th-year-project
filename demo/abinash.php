<?php
// Generate a new RSA key pair
$rsa = openssl_pkey_new(array(
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
));

// Extract the private key and public key
openssl_pkey_export($rsa, $private_key);
$public_key = openssl_pkey_get_details($rsa)['key'];

// Set the image path
$image_path = 'a.png';

// Read the image file and get its content
$image_content = file_get_contents($image_path);

// Encrypt the image content using RSA public key
openssl_public_encrypt($image_content, $encrypted_content, $public_key);
// Save the encrypted content as an image file
file_put_contents('encrypted_image.png', $encrypted_content);

// Decrypt the encrypted content using RSA private key
openssl_private_decrypt($encrypted_content, $decrypted_content, $private_key);

// Save the decrypted content as an image file
file_put_contents('decrypted_image.png', $decrypted_content);

?>