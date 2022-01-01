<?php
session_start();
error_reporting(0);

$mysql_server_name="lastctf_mysql";
$mysql_database="lastctf";
$mysql_username="userctf";
$mysql_password="userctf";

$conn = mysqli_connect($mysql_server_name, $mysql_username,$mysql_password,$mysql_database);

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

function cek_signature($string, $signature){
    $string = urldecode(strtolower($string));
    $signature = urldecode($signature);
    if(generate_signature($string) !== $signature){
        die('Invalid Signature Request');
    }
}

function generate_signature($string){
    $string = urldecode(strtolower($string));
    $key = session_id();
    $signature = sha1(hash_hmac('sha1', $string , $key, $raw_output=TRUE));
    return $signature;
}

if(isset($_REQUEST['id']) && !isset($_REQUEST['signature'])){
    die('Invalid Request');
}else if(isset($_REQUEST['id']) && isset($_REQUEST['signature'])){
    $signature = generate_signature($_REQUEST['id']);
    cek_signature($_REQUEST['id'], $_REQUEST['signature']);
    $id = $_REQUEST['id'];
    $query = "select * from chal where id='$id'";
    if(isset($_GET['debug'])){
        highlight_string($query);
    }
    $data = mysqli_query($conn, $query);
    $rs = mysqli_fetch_array($data, MYSQLI_ASSOC);
}else{
    $query = "select * from chal";
    if(isset($_GET['debug'])){
        highlight_string($query);
    }
    $data = mysqli_query($conn, $query);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-light bg-light mb-3">
        <div class="container">
            <div class="col-12">
                <a class="navbar-brand" href="/index.php">
                    <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24">
                </a>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="col-12">
            <nav class="nav flex-column">
                <a href="/index.php" class="nav-link active">Home</a>
                <a href="/index.php?id=1&signature=<?php echo generate_signature('1');?>" class="nav-link">Cek Post</a>
                <a href="/index.php?id=2&signature=<?php echo generate_signature('2');?>" class="nav-link">Cek Post 2</a>
            </nav>

            <div class="row">
                <div class="col-12">
                <?php if(isset($rs)):?>
                    <?php echo $rs['name'] ;?>
                <?php endif ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
<!-- 
REQUEST for debug
-->