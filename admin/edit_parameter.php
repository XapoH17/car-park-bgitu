<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

if (!array_key_exists('id', $_GET)) {
    throw new Error('GET-variable id is required');
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM parameters where id ='$id'";
    
$result = mysqli_query($link, $sql);

if (!mysqli_num_rows($result)) {
    throw new Error('Parameter ' . $id . ' not found.');
}

$parameter = mysqli_fetch_object($result);

$parameterValues = mysqli_fetch_all(mysqli_query($link, "SELECT * FROM parameter_values where parameter_id='$id'"), MYSQLI_ASSOC);

renderTemplate('edit_parameter', [
    'header' => 'Изменения характеристики',
    'parameter' => $parameter,
    'parameterValues' => $parameterValues
]);

clearFlash();