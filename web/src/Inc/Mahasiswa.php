<?php 
class Mahasiswa
{
    public $nama;
    public $isAuth;

    public function daftar()
    {
        if($this->isAuth){
            echo readfile("/application/src/secret.txt");
        }else{
            echo "Halo " .$this->nama;
        }
    }
}