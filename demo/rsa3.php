<?Php
// Generate a new RSA key pair
$private_key = openssl_pkey_new(array(
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
));

// Extract the public key from the key pair
$public_key = openssl_pkey_get_details($private_key)["key"];

// Encrypt the string "ABINASH" with the public key
$data = "ABINASH";
$ciphertext = "";
openssl_public_encrypt($data, $ciphertext, $public_key);

// Decrypt the ciphertext with the private key
$plaintext = "";
openssl_private_decrypt($ciphertext, $plaintext, $private_key);

// Output the public key, private key, ciphertext, and plaintext
echo "Public key:\n$public_key\n\n";
echo "Private key:\n" . openssl_pkey_export($private_key) . "\n\n";
echo "Ciphertext:\n" . base64_encode($ciphertext) . "\n\n";
echo "Plaintext:\n$plaintext\n\n";

?>