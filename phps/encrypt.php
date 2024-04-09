<?php 
// Configuration settings for the key
// $config = array(
//     "digest_alg" => "sha512",
//     "private_key_bits" => 4096,
//     "private_key_type" => OPENSSL_KEYTYPE_RSA,
// );

// // Create the private and public key
// $res = openssl_pkey_new($config);

// // Extract the private key into $private_key
// openssl_pkey_export($res, $private_key);

// // Extract the public key into $public_key
// $public_key = openssl_pkey_get_details($res);
// $public_key = $public_key["key"];


// // Something to encrypt
// $text = 'This is the text to encrypt';

// echo "This is the original text: $text\n\n";

// // Encrypt using the public key
// openssl_public_encrypt($text, $encrypted, $public_key);

// $encrypted_hex = bin2hex($encrypted);
// echo "This is the encrypted text: $encrypted_hex\n\n";

// // Decrypt the data using the private key
// openssl_private_decrypt($encrypted, $decrypted, $private_key);

// echo "This is the decrypted text: $decrypted\n\n";


// $private_key = openssl_pkey_new();
// $public_key_pem = openssl_pkey_get_details($private_key)['key'];
// echo $public_key_pem;
// $public_key = openssl_pkey_get_public($public_key_pem);
// var_dump($public_key);