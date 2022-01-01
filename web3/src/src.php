<?php
if(isset($_GET['id'])){
    if(preg_match("/(?:\w*)\W*?[a-z].*(R|ELECT|OIN|NTO|HERE|NION)/i", $_GET['id'])){
        die("Invalid Request");
    }else{
        validate($_GET['id']);
    }
}

function validate($id)
{
    $blacklist  = "pad|admin|'|\"|substr|mid|concat|char|ascii|left|right|for|from|where|having";
    $blacklist .= "insert|username|or|and|=|#|\.|\_|like|between|reg|&|load|file|glob|cast|out";
    $blacklist .= "user|rev|0x|conv|hex|from|innodb|\^|union|benchmark|if|case|coalesce|max|strcmp|proc|group|rand|floor|pow";
    if (preg_match("/$blacklist/i", $id)){
        die("Blocked Request");
    }
}