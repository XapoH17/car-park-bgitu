<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

$parameters = mysqli_fetch_all(mysqli_query($link, "SELECT * FROM parameters"), MYSQLI_ASSOC);

include 'views' . DIRECTORY_SEPARATOR . '_header.phtml';

include 'views' . DIRECTORY_SEPARATOR . 'parameters.phtml';

include 'views' . DIRECTORY_SEPARATOR . '_footer.phtml';


