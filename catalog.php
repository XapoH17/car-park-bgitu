<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

$result = mysqli_query($link, "SELECT * FROM products");

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

include 'views' . DIRECTORY_SEPARATOR . '_header.phtml';

include 'views' . DIRECTORY_SEPARATOR . 'catalog.phtml';

include 'views' . DIRECTORY_SEPARATOR . '_footer.phtml';
