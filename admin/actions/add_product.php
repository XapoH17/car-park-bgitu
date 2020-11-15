<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {   
    throw new ErrorException('Required POST query.');
}

validateRequired($_POST, 'name');

$name = mysqli_real_escape_string($link, trim($_POST['name']));

if (!mysqli_query($link, "INSERT INTO products(name) VALUES ('$name')")) {
    $_SESSION['flash'] = [
        'name' => $name,
        'message' => mysqli_error($link),
    ];

    header('Location: /admin/add_product.php'); 
    
    exit;
}

$id = mysqli_insert_id($link);

$parameters = getParameters();

foreach ($parameters as $parameter) {
    $parameterValueId = intval($_POST['parameter_' . $parameter->id]);
    
    if ($parameterValueId) {
        mysqli_query($link, "INSERT INTO parameter_value_product (parameter_value_id, product_id) VALUES($parameterValueId, $id)");
    }
}

header('Location: /admin/manage_products.php');