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

$result = mysqli_query($link, "SELECT * FROM parameter_values where id=$id");

if (!mysqli_num_rows($result)) {
    throw new Error('Parameter value ' . $id . ' not found.');
}

if (!mysqli_query($link, "UPDATE parameter_values SET name='$name' WHERE id=$id")) {
    $_SESSION['flash'] = [
        'name' => $name,
        'message' => mysqli_error($link),
    ];

    header('Location: /admin/edit_parameter_value.php?id=' . $id); 
    
    exit;
}

$parameterValue = mysqli_fetch_object($result);

header('Location: /admin/edit_parameter.php?id=' . $parameterValue->parameter_id);