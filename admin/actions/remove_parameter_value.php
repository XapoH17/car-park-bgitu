<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

if (!array_key_exists('id', $_GET)) {
    throw new Error('Id is required');
}

$id = intval($_GET['id']);

$result = mysqli_query($link, "SELECT * FROM parameter_values where id=$id");

if (!mysqli_num_rows($result)) {
    throw new Error('Parameter value ' . $id . ' not found.');
}

mysqli_query($link, "DELETE FROM parameter_values WHERE id=$id");

$parameterValue = mysqli_fetch_object($result);

header('Location: /admin/edit_parameter.php?id=' . $parameterValue->parameter_id);