<?php
class Controller
{
    public $db = null;
    public $model = null;

    function __construct()
    {
        $this->openDatabaseConnection();
    }

    private function openDatabaseConnection()
    {
        $this->db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if (!$this->db) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_set_charset($this->db,"utf8");
    }


    public function validate($name, $clause)
    {
        $blacklist  = "pad|admin|'|\"|substr|mid|concat|char|ascii|left|right|for|from|where|having";
        $blacklist .= "insert|username|or|and|=|#|\.|\_|like|between|reg|&|load|file|glob|cast|out";
        $blacklist .= "user|rev|0x|conv|hex|from|innodb|\^|union|benchmark|if|case|coalesce|max|strcmp|proc|group|rand|floor|pow";
        if (preg_match("/$blacklist/i", $name)){
            die("Hidup bukan tentang menunggu badai berlalu, tetapi belajar menari di tengah hujan.");
        }
        if(preg_match("/$blacklist/i", $clause)){
            die("Hidup kita mulai berakhir saat kita menjadi diam tentang hal-hal yang penting");
        }
    }

    public function validate_post($url){
        if(preg_match("/(dict|ftp|scp|ldap|data|php|ssh|file)/i",$url)){
            die("Optimistis adalah salah satu kualitas yang lebih terkait dengan kesuksesan dan kebahagiaan daripada yang lain");
        }
    }
}