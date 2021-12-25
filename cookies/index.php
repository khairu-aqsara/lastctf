<?php 
session_start();
$flag = "lastctf{m4t4_4nd4_sun99uh_j3l1}";
$arr2 = str_split($flag, 1);
if(!isset($_SESSION['req'])){
    $_SESSION['req'] = 0;
}else{
    if($_SESSION['req'] < 30){
        $_SESSION['req'] = $_SESSION['req'] + 1;
    }else{
        $_SESSION['req'] = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Found Page</title>
        <link rel="alternate" type="application/hash" title="Not Found Page" href="#" content="<?php echo md5($arr2[$_SESSION['req']]);?>"/>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">404</div>
            <div class="message" style="padding: 10px;">Not Found</div>
        </div>
    </body>
</html>
