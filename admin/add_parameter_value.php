<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

if (!array_key_exists('parameter_id', $_GET)) {
    throw new Error('GET-variable paremter_id is required');
}

$parameterId = intval($_GET['parameter_id']);

$sql = "SELECT * FROM parameters where id ='$parameterId'";
    
$result = mysqli_query($link, $sql);

if (!mysqli_num_rows($result)) {
    throw new Error('Parameter ' . $parameterId . ' not found.');
}

$parameter = mysqli_fetch_object($result);

include 'views' . DIRECTORY_SEPARATOR . '_header.phtml';

include 'views' . DIRECTORY_SEPARATOR . 'add_parameter_value.phtml';

include 'views' . DIRECTORY_SEPARATOR . '_footer.phtml';

clearFlash();