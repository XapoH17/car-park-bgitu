<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {   
    throw new ErrorException('Required POST query.');
}

validateRequired($_POST, 'parameter_id');
validateRequired($_POST, 'name');

$parameterId = intval($_POST['parameter_id']);
$name = mysqli_real_escape_string($link, trim($_POST['name']));

$result = mysqli_query($link, "SELECT * FROM parameters where id=$parameterId");

if (!mysqli_num_rows($result)) {
    throw new Error('Parameter ' . $parameterId . ' not found.');
}

if (!mysqli_query($link, "INSERT INTO parameter_values (parameter_id, name) VALUES ($parameterId, '$name')")) {
    $_SESSION['flash'] = [
        'name' => $name,
        'message' => mysqli_error($link),
    ];

    header('Location: /admin/add_parameter_value.php?parameter_id=' . $parameterId); 
    
    exit;
}

$parameterValue = mysqli_fetch_object($result);

header('Location: /admin/edit_parameter.php?id=' . $parameterId);