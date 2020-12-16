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

if (!mysqli_query($link, "UPDATE products SET name='$name' WHERE id=$id")) {
    $_SESSION['flash'] = [
        'message' => mysqli_error($link),
    ];

    header('Location: /admin/edit_product.php?id=' . $id); 
    
    exit;
}

/**
 * @desc Загрузка файла
 */

$uploadPath = BASE_PATH . '/images/products/' . $id . '.jpg';

if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
    echo "Файл успешно загружен";
    $_SESSION['flash'] = [
        'message' => "Файл не загружен",
    ];
}

$parameters = getParameters();

foreach ($parameters as $parameter) {
    $parameterValueId = intval($_POST['parameter_' . $parameter->id]);
    
    $result = mysqli_query($link, "SELECT pvp.parameter_value_id FROM parameters p JOIN parameter_values pv ON p.id=pv.parameter_id JOIN parameter_value_product pvp ON pv.id=pvp.parameter_value_id WHERE pvp.product_id=$id and p.id=$parameter->id");
    
    $currentConnectedParameterValueId = null;
    
    if (mysqli_num_rows($result)) {
        $currentConnectedParameterValueId = mysqli_fetch_row($result)[0];
    }
    
    if ($parameterValueId) {
        if ($currentConnectedParameterValueId) {
            if ($currentConnectedParameterValueId != $parameterValueId) {
                mysqli_query($link, "DELETE FROM parameter_value_product WHERE parameter_value_id=$currentConnectedParameterValueId AND product_id=$id");
                
                mysqli_query($link, "INSERT INTO parameter_value_product (parameter_value_id, product_id) VALUES($parameterValueId, $id)");
            }
        } else {
            mysqli_query($link, "INSERT INTO parameter_value_product (parameter_value_id, product_id) VALUES($parameterValueId, $id)");
        }
    } else {
        if ($currentConnectedParameterValueId) {
            mysqli_query($link, "DELETE FROM parameter_value_product WHERE parameter_value_id=$currentConnectedParameterValueId AND pvp.product_id=$id");
        }
    }
}

header('Location: /admin/manage_products.php');