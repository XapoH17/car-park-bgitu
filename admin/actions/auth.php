<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

if (!isAuth()) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        validateRequired($_POST, 'login');
        validateRequired($_POST, 'pass');

        auth($_POST['login'], $_POST['pass']);
    } else {
        throw new ErrorException('Auth required POST method.');
    }
}

header('Location: /admin/');