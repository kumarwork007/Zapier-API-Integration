<?php
$string="1";
$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), 100);
$encrypted_string = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, "ABCDEF", $string, MCRYPT_MODE_CBC, $iv);
$decrypted_string = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, "ABCDEF", $encrypted_string, MCRYPT_MODE_CBC, $iv);
echo "Original string : " . $string . "<br />\n";
echo "Encrypted string : " . $encrypted_string . "<br />\n";
echo "Decrypted string : " . $decrypted_string . "<br />\n";
function encr($string){$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), "abc");
$encrypted_string = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, "ABCDEF", $string, MCRYPT_MODE_CBC, $iv);
return $encrypted_string;
}
function decr($encrypted_string){$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), "abc");
$decrypted_string = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, "ABCDEF", $encrypted_string, MCRYPT_MODE_CBC, $iv);
return $decrypted_string;
}
$en=encr('1');
$de=decr($en);
echo $en."<br/> \n";
echo $de;
	?>