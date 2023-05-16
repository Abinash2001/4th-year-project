<?php
// // Load the image data from file
// $image_data = file_get_contents("a.png");

// // Generate a new RSA key pair
// $private_key = openssl_pkey_new(array(
//     "private_key_bits" => 2048,
//     "private_key_type" => OPENSSL_KEYTYPE_RSA,
// ));

// // Extract the public key from the key pair
// $public_key = openssl_pkey_get_details($private_key)["key"];

// // Encrypt the image data with the public key
// $ciphertext = "";
// openssl_public_encrypt($image_data, $ciphertext, $public_key);

// // Save the encrypted image data to a text file
// file_put_contents("encrypted_image.txt", base64_encode($ciphertext));

// // Optionally, you can also save the public and private keys to files
// file_put_contents("public_key.pem", $public_key);
// file_put_contents("private_key.pem", openssl_pkey_export($private_key, $private_key_passphrase));

// // Load the encrypted image data from the text file
// $ciphertext = base64_decode(file_get_contents("encrypted_image.txt"));

// // Load the private key from file
// $private_key = openssl_pkey_get_private(file_get_contents("private_key.pem"), $private_key_passphrase);

// // Decrypt the ciphertext with the private key
// $plaintext = "";
// openssl_private_decrypt($ciphertext, $plaintext, $private_key);

// // Save the decrypted image data to file
// file_put_contents("decrypted_image.png", $plaintext);




// Load the image data from file
$image_data = file_get_contents("a.png");

// Generate a new RSA key pair
$private_key = openssl_pkey_new(array(
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
));

// Extract the public key from the key pair
$public_key = openssl_pkey_get_details($private_key)["key"];

// Encrypt the image data with the public key
$ciphertext = "";
openssl_public_encrypt($image_data, $ciphertext, $public_key);


$encrypted_image = base64_encode($ciphertext);
file_put_contents('encrypted_image.txt', $encrypted_image);
// Save the encrypted image data to a text file
// file_put_contents("encrypted_image.txt", base64_encode($ciphertext));

// Optionally, you can also save the public and private keys to files
// file_put_contents("public_key.pem", $public_key);
// file_put_contents("private_key.pem", openssl_pkey_export($private_key));

// Load the encrypted image data from the text file
// $ciphertext = base64_decode(file_get_contents("encrypted_image.txt"));

// Load the private key from file
// $private_key = openssl_pkey_get_private(file_get_contents("private_key.pem"));
$private_key = openssl_pkey_get_private($private_key);

// Decrypt the ciphertext with the private key
$plaintext = "";
openssl_private_decrypt($ciphertext, $plaintext, $private_key);

// Save the decrypted image data to file
file_put_contents("decrypted_image.png", $plaintext);

?>