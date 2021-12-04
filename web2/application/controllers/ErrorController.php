<?php
class ErrorController extends Controller
{
    public function index()
    {
        require APP . 'views/_templates/header.php';
        require APP . 'views/error/index.php';
        require APP . 'views/_templates/footer.php';
    }
}