<?php 
include "Inc/Logfile.php";
include "Inc/Mahasiswa.php";
try{
    $mahasiswa = unserialize($_POST['nama']);
    $mahasiswa->daftar();
}catch(Exception $e){
    var_dump($e->getMessage());
}

