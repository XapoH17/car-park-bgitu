<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

if (isAuth()) {
    unset($_SESSION['login']);
    
    unset($_SESSION['pass']);
    
    unset($_SESSION['flash']);
}

header('Location: /');