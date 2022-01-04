<html>
<head>
    <title>Kontak Kami</title>
</head>
<body> 
    <h1>Kontak Kami</h1>
    <form  action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="submit">
        Your name:<br>
        <input name="name" type="text" value="" size="30"/><br>
        Your email:<br>
        <input name="email" type="text" value="" size="30"/><br>
        Your message:<br>
        <textarea name="message" rows="7" cols="30"></textarea><br>
        <input type="submit" value="Kirim Pesan"/>
    </form>
    <pre>
<?php
if (isset($_REQUEST['action'])){
    $email_from=$_REQUEST['name'];
    $email=$_REQUEST['email'];
    $msg_body=$_REQUEST['message'];
    if (($email_from=="")||($email=="")||($msg_body=="")){
        echo "There are missing fields.";
    }else{		

        require_once('src/class.phpmailer.php');
        $mail = new PHPMailer(); // defaults to using php "mail()"
        
        $mail->SetFrom($email_from, 'Client Name');
        
        $address = "customer_feedback@company-X.com";
        $mail->AddAddress($address, "Some User");
        
        $mail->Subject    = "PHPMailer PoC Exploit CVE-2016-10033";
        $mail->MsgHTML($msg_body);
        
        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
          echo "Message sent!\n";
        }

    }
}  
?>
    </pre>

    </body> 
</html>