<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

if (!isAuth()) {
    renderTemplate('auth', [
        'header' => 'Авторизация'
    ]);
} else {
    renderTemplate('', [
        'header' => 'Привет',
        'subheader' => $user->login
    ]);
}

clearFlash();
