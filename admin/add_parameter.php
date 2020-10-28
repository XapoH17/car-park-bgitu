<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

renderTemplate('add_parameter', [
    'header' => 'Добавить новую характеристику',
]);

clearFlash();
