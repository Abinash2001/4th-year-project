<?php 
// Encryption
// $key = 'mysecretkey12345';
$key = openssl_random_pseudo_bytes(32);
file_put_contents('key.bin', $key);
// $plaintext_text = 'Souvik';
$original_image = file_get_contents('a.png');

// Generate a random IV
$ivlen = openssl_cipher_iv_length('aes-256-cbc');
$iv = openssl_random_pseudo_bytes($ivlen);

// Encrypt the plaintext
// $ciphertext = openssl_encrypt($plaintext_text, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
$original_image = file_get_contents('a.png');
$encrypted_image = openssl_encrypt($original_image, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

// Combine the IV and ciphertext into a single string
$encrypted_image_data = base64_encode($iv . $encrypted_image);

// Output the encrypted message
echo "Encrypted message: $encrypted_image_data\n";

// Decryption
$encrypted_data = base64_decode($encrypted_image_data);

// Separate the IV and ciphertext
$ivlen = openssl_cipher_iv_length('aes-256-cbc');
$iv = substr($encrypted_data, 0, $ivlen);
$ciphertext = substr($encrypted_data, $ivlen);

// Decrypt the ciphertext
$plaintext_text = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
echo '<br>';
// Output the decrypted message
echo "Decrypted message: $plaintext_text\n";

?>