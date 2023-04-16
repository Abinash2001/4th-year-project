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

// Save public and private keys to files
file_put_contents('private_key.pem', $private_key);
file_put_contents('public_key.pem', $public_key);


$data = "abinash";
$ciphertext = "";

echo $public_key;
echo "<br>";
echo "<br>";
echo "<br>";
echo $private_key;
openssl_public_encrypt($data, $ciphertext, $public_key);
echo "<br><br><br><br>";
echo $ciphertext;
file_put_contents('cipher.bin', $ciphertext);
echo "<br><br><br><br>";

$plaintext = "";
openssl_private_decrypt($ciphertext, $plaintext, $private_key);
echo $plaintext;
echo "<br><br><br><br>";


//------------------------------------ image rsa ------------------------------------//

// Generate public and private keys
// $config = array(
//     "digest_alg" => "sha512",
//     "private_key_bits" => 4096,
//     "private_key_type" => OPENSSL_KEYTYPE_RSA,
// );
// $rsa_key = openssl_pkey_new($config);
// openssl_pkey_export($rsa_key, $private_key);
// $public_key = openssl_pkey_get_details($rsa_key);
// $public_key = $public_key["key"];

// // Save public and private keys to files
// file_put_contents('private_key.pem', $private_key);
// file_put_contents('public_key.pem', $public_key);

// Encrypt image
$key = openssl_random_pseudo_bytes(32);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

$original_image = file_get_contents('a.png');
$encrypted_image = openssl_encrypt($original_image, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

$encrypted_key = '';
openssl_public_encrypt($key, $encrypted_key, $public_key);

$enc_image_data = $encrypted_key . $iv . $encrypted_image;
$encrypted_image_data = base64_encode($enc_image_data);

file_put_contents('encrypted_image.bin', $encrypted_image_data);

// Decrypt image
$encrypted_image_data = file_get_contents('encrypted_image.bin');
$enc_image_data = base64_decode($encrypted_image_data);

$key_size = openssl_pkey_get_details(openssl_pkey_get_public($public_key));
$key_size = $key_size["bits"];

$encrypted_key_size = ceil($key_size / 8);
$iv_size = openssl_cipher_iv_length('aes-256-cbc');
$encrypted_key = substr($enc_image_data, 0, $encrypted_key_size);
$iv = substr($enc_image_data, $encrypted_key_size, $iv_size);
$encrypted_image = substr($enc_image_data, $encrypted_key_size + $iv_size);
$decrypted_key = '';
openssl_private_decrypt($encrypted_key, $decrypted_key, $private_key);
$decrypted_image = openssl_decrypt($encrypted_image, 'aes-256-cbc', $decrypted_key, OPENSSL_RAW_DATA, $iv);

file_put_contents('decrypted_image.jpg', $decrypted_image);
echo "Decrypted image written to 'decrypted_image.jpg'\n";
?>