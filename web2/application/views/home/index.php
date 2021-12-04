<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>
<div class="container">
    <?php if(isset($message)){ echo $message ;} ?>
</div>

<!--
$blacklist  = "pad|admin|'|\"|substr|mid|concat|char|ascii|left|right|for| |from|where|having";
$blacklist .= "insert|username|\/|-|go_to|\||or|and|\\|=|#|\.|\_|like|between|reg|&|load|file|glob|cast|out|0";
$blacklist .= "user|rev|0x|limit|conv|hex|from|innodb|\^|union|benchmark|if|case|coalesce|max|strcmp|proc|group|rand|floor|pow";

mysqli_set_charset($this->db,"utf8");

if(isset($_GET['name']) && isset($_GET['kondisi'])){
    $this->validate($_GET['name'], $_GET['kondisi']);
    $query="select * from chal /*". $_GET['kondisi'] . "*/ username='" . $_GET['name'] . "'";
}else{
    $query="select * from chal where username='".DEFAULT_USERNAME."'";
}

$result=mysqli_query($this->db,$query);

if($result){
    $row=mysqli_fetch_array($result);
    if($row['username']=="admin"){
        $_SESSION['islogin'] = true;
        header("Location:{$row['link']}");
    }else{
        $message = "Anda tidak punya akses sebagai Administrator";
    }
}else{
    $message = "Sepertinya Query nya bermasalah";
}
-->