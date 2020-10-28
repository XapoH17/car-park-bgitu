<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {   
    throw new ErrorException('Required POST query.');
}

validateRequired($_POST, 'id');
validateRequired($_POST, 'name');

$id = intval($_POST['id']);
$name = mysqli_real_escape_string($link, trim($_POST['name']));

if (!mysqli_query($link, "UPDATE parameters SET name = '$name' WHERE id='$id'")) {
    $_SESSION['flash'] = [
        'name' => $name,
        'message' => mysqli_error($link),
    ];

    header('Location: /admin/edit_parameters.php?id=' . $id); 
    
    exit;
}

header('Location: /admin/parameters.php');