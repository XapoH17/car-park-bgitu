<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {   
    throw new ErrorException('Required POST query.');
}

validateRequired($_POST, 'name');

$name = mysqli_real_escape_string($link, trim($_POST['name']));

if (!mysqli_query($link, "INSERT INTO parameters(name) VALUES ('$name')")) {
    $_SESSION['flash'] = [
        'name' => $name,
        'message' => mysqli_error($link),
    ];

    header('Location: /admin/add_parameter.php'); 
    
    exit;
}

header('Location: /admin/parameters.php');