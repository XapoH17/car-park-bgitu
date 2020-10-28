<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

if (!array_key_exists('id', $_GET)) {
    throw new Error('GET-variable id is required');
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM parameter_values where id ='$id'";
    
$result = mysqli_query($link, $sql);

if (!mysqli_num_rows($result)) {
    throw new Error('Parameter ' . $id . ' not found.');
}

/**
paremeterValue
parameter_id



-id
**/

$parameterValue = mysqli_fetch_object($result);

$parameter = mysqli_fetch_object(mysqli_query($link, "SELECT * FROM parameters where id=$parameterValue->parameter_id"));

include 'views' . DIRECTORY_SEPARATOR . '_header.phtml';

include 'views' . DIRECTORY_SEPARATOR . 'edit_parameter_value.phtml';

include 'views' . DIRECTORY_SEPARATOR . '_footer.phtml';

clearFlash();