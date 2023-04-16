<?php

// Step 1: Choose two large prime numbers, p and q
$p = 61;
$q = 53;

// Step 2: Calculate n = p * q
$n = $p * $q;

// Step 3: Calculate φ(n) = (p-1) * (q-1)
$phi_n = ($p-1) * ($q-1);

// Step 4: Choose an integer e such that 1 < e < φ(n) and gcd(e, φ(n)) = 1
$e = 17;

// Step 5: Calculate d such that d * e ≡ 1 (mod φ(n))
$d = gmp_invert($e, $phi_n);

// Step 6: The public key is (n, e)
$public_key = array($n, $e);

// Step 7: The private key is (n, d)
$private_key = array($n, $d);

// function strigToBinary($string)
// {
//     $characters = str_split($string);
 
//     $binary = [];
//     foreach ($characters as $character) {
//         $data = unpack('H*', $character);
//         $binary[] = base_convert($data[1], 16, 2);
//     }
 
//     return implode(' ', $binary);    
// }
// Encrypt a message using the public key
function encrypt($message, $public_key) {
  // Convert the message to an integer
  $m = gmp_init($message);
  // $m = strigToBinary($message);
  // Calculate the ciphertext C ≡ M^e (mod n)
  $n = gmp_init($public_key[0]);
  $e = gmp_init($public_key[1]);
  $ciphertext = gmp_powm($m, $e, $n);
// echo $ciphertext;
  // Convert the ciphertext back to a string
  $c = gmp_strval($ciphertext);
  return $c;
  // return $ciphertext;
}
// function binaryToString($binary)
// {
//     $binaries = explode(' ', $binary);
 
//     $string = null;
//     foreach ($binaries as $binary) {
//         $string .= pack('H*', dechex(bindec($binary)));
//     }
 
//     return $string;    
// }

// Decrypt a ciphertext using the private key
function decrypt($ciphertext, $private_key) {
  // Convert the ciphertext to an integer
  $c = gmp_init($ciphertext);
  // Calculate the plaintext M ≡ C^d (mod n)
  $n = gmp_init($private_key[0]);
  $d = gmp_init($private_key[1]);
  $plaintext = gmp_powm($c, $d, $n);
  // Convert the plaintext back to a string
  $m = gmp_strval($plaintext);
  // $m = binaryToString($plaintext);..
  // echo $m;
  return $m;
}

// Example usage
$message = 123456789;
$ciphertext = encrypt($message, $public_key);
$plaintext = decrypt($ciphertext, $private_key);

echo "<br>Original message: $message\n";
echo "<br>Ciphertext: $ciphertext\n";
echo "<br>Decrypted message: $plaintext\n";




/*
// Step 1: Choose two large prime numbers, p and q
$p = 61;
$q = 53;

// Step 2: Calculate n = p * q
$n = $p * $q;

// Step 3: Calculate φ(n) = (p-1) * (q-1)
$phi_n = ($p-1) * ($q-1);

// Step 4: Choose an integer e such that 1 < e < φ(n) and gcd(e, φ(n)) = 1
$e = 17;

// Step 5: Calculate d such that d * e ≡ 1 (mod φ(n))
$d = gmp_invert($e, $phi_n);

// Step 6: The public key is (n, e)
$public_key = array($n, $e);

// Step 7: The private key is (n, d)
$private_key = array($n, $d);

// function strigToBinary($string)
// {
//     $characters = str_split($string);
 
//     $binary = [];
//     foreach ($characters as $character) {
//         $data = unpack('H*', $character);
//         $binary[] = base_convert($data[1], 16, 2);
//     }
 
//     return implode(' ', $binary);    
// }
// Encrypt a message using the public key
function encrypt($message, $public_key) {
  // Convert the message to an integer
  $m = gmp_init($message);
  // $m = strigToBinary($message);
  // Calculate the ciphertext C ≡ M^e (mod n)
  $n = gmp_init($public_key[0]);
  $e = gmp_init($public_key[1]);
  $ciphertext = gmp_powm($m, $e, $n);
// echo $ciphertext;
  // Convert the ciphertext back to a string
  $c = gmp_strval($ciphertext);
  // return $c;
  return $ciphertext;
}
// function binaryToString($binary)
// {
//     $binaries = explode(' ', $binary);
 
//     $string = null;
//     foreach ($binaries as $binary) {
//         $string .= pack('H*', dechex(bindec($binary)));
//     }
 
//     return $string;    
// }

// Decrypt a ciphertext using the private key
function decrypt($ciphertext, $private_key) {
  // Convert the ciphertext to an integer
  $c = gmp_init($ciphertext);
  // Calculate the plaintext M ≡ C^d (mod n)
  $n = gmp_init($private_key[0]);
  $d = gmp_init($private_key[1]);
  $plaintext = gmp_powm($c, $d, $n);
  // Convert the plaintext back to a string
  $m = gmp_strval($plaintext);
  // $m = binaryToString($plaintext);
  // echo $m;
  return $m;
}

// Example usage
$message = "Hello";
$ciphertext = encrypt($message, $public_key);
$plaintext = decrypt($ciphertext, $private_key);

echo "<br>Original message: $message\n";
echo "<br>Ciphertext: $ciphertext\n";
echo "<br>Decrypted message: $plaintext\n";*/

?>
