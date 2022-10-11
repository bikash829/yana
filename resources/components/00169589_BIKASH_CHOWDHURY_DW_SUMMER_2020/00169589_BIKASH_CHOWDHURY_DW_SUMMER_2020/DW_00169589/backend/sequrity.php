<?php
function encrypted_value($plain_text){
    // Store the cipher method
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';

    // Store the encryption key
    $encryption_key = md5("its very Secret");

    // Use openssl_encrypt() function to encrypt the data
    $encryption = openssl_encrypt($plain_text, $ciphering,
    $encryption_key, $options, $encryption_iv);

    //    $convert_md5 = md5($encryption);

    // Display the encrypted string
    return $encryption;
}

function decrypted_value($cypher_text){
    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';

    // Store the decryption key
    $decryption_key = md5("its very Secret");

    // Store the cipher method
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;


    // Use openssl_decrypt() function to decrypt the data
    $decryption=openssl_decrypt ($cypher_text, $ciphering,
    $decryption_key, $options, $decryption_iv);

// Display the decrypted string
return $decryption;
}

?>