<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

if (!array_key_exists('id', $_GET)) {
    throw new Error('GET-variable id is required');
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM products where id ='$id'";
    
$result = mysqli_query($link, $sql);

if (!mysqli_num_rows($result)) {
    throw new Error('Product ' . $id . ' not found.');
}

$product = mysqli_fetch_object($result);

// select pvp.parameter_value_id from products p join paramter_value_product pvp on p.id=pvp.product_id where p.id=$id
$parameterValueProduct = mysqli_fetch_all(mysqli_query($link, "select pvp.parameter_value_id from products p join parameter_value_product pvp on p.id=pvp.product_id where p.id=$id"), MYSQLI_NUM);

$parameterValuesId = [];

foreach($parameterValueProduct as $parameterValueProductItem) {
    $parameterValuesId[] = $parameterValueProductItem[0];
}
    
$parameters = getParameters();

include 'views' . DIRECTORY_SEPARATOR . '_header.phtml';

include 'views' . DIRECTORY_SEPARATOR . 'edit_product.phtml';

include 'views' . DIRECTORY_SEPARATOR . '_footer.phtml';

clearFlash();