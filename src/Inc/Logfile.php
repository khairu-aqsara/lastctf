<?php 
class Logfile {
    public function __wakeup()
    {
        file_put_contents($this->filename, $this->content);
    }
}