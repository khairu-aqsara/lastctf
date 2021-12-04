<?php

class Home extends Controller
{
    public function index()
    {
        if(isset($_GET['name']) && isset($_GET['kondisi'])){
            $this->validate($_GET['name'], $_GET['kondisi']);
            $query="select * from chal /*". $_GET['kondisi'] . "*/ username='" . $_GET['name'] . "'";
        }else{
            $query="select * from chal where username='".DEFAULT_USERNAME."'";
        }
        echo $query;
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
        require APP . 'views/_templates/header.php';
        require APP . 'views/home/index.php';
        require APP . 'views/_templates/footer.php';
    }

    public function iniadalahhalamanadmin()
    {
        if(!isset($_SESSION['islogin'])){
            header('location: ' . URL_WITH_INDEX_FILE . 'home/index');
        }

        if(isset($_POST['url'])){
            $url = $_POST['url'];
            $this->validate_post($url);
            $cSession = curl_init();
            curl_setopt($cSession,CURLOPT_URL,$url);
            curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($cSession,CURLOPT_HEADER, false);
            $result=curl_exec($cSession);
            curl_close($cSession);
        }
        require APP . 'views/_templates/header.php';
        require APP . 'views/home/admin.php';
        require APP . 'views/_templates/footer.php';
    }
}