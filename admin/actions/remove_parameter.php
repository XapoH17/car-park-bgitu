<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

if (!array_key_exists('id', $_GET)) {
    throw new Error('Id is required');
}

mysqli_query($link, "DELETE FROM parameters WHERE id='" . intval($_GET['id']) . "'");

header('Location: /admin/parameters.php');