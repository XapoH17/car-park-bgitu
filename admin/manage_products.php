<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'kernel.php';

checkAuth();

$allowedSorts = [
    'name_asc',
    'name_desc',
];

$sortLabels = [
    'name_asc' => 'От А до Я',
    'name_desc' => 'От Я до А',
];

$currentSort = 'name_asc';

if (array_key_exists('sort', $_GET)) {
    if (in_array($_GET['sort'], $allowedSorts)) {
        $currentSort = $_GET['sort'];
    }
}

$getOrderBy = function ($sort) {
    switch ($sort) {
        case 'name_asc':
            return 'p.name ASC';
            break;
        case 'name_desc':
            return 'p.name DESC';
            break;
        case 'price_asc':
            return 'p.price ASC';
            break;
        case 'price_desc':
            return 'p.price DESC';
            break;
    }
};

$q = '';

if (array_key_exists('q', $_GET) && trim($_GET['q'])) {
    $q = mysqli_real_escape_string($link, trim($_GET['q']));
}

$getSearchWhere = function ($q) {
    if ($q) {
        return "AND (p.name LIKE '%$q%' OR pv.name LIKE '%$q%')";
    }
};

$fromSql = "products p LEFT JOIN parameter_value_product pvp ON p.id=pvp.product_id LEFT JOIN parameter_values pv ON pvp.parameter_value_id=pv.id";

$perPage = 3;

$page = 1;

if (array_key_exists('page', $_GET)) {
    $page = intval($_GET['page']);
}

$getOffsetAndLimit = function ($page, $perPage) {
    $offset = ($page-1) * $perPage;
    
    return "$offset,$perPage";
};

$sqlCount = "SELECT COUNT(DISTINCT p.id) FROM $fromSql WHERE 1=1 " . $getSearchWhere($q);

$productsCount = mysqli_fetch_row(mysqli_query($link, $sqlCount))[0];

$sql = "SELECT DISTINCT p.* FROM $fromSql WHERE 1=1 " . $getSearchWhere($q) . " ORDER BY " . $getOrderBy($currentSort) . " LIMIT " . $getOffsetAndLimit($page, $perPage);

$result = mysqli_query($link, $sql);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

$pvpRows = mysqli_fetch_all(
    mysqli_query($link, "SELECT p.id, pvp.parameter_value_id, pvp.product_id, pv.name FROM parameters p LEFT JOIN parameter_values pv ON p.id=pv.parameter_id LEFT JOIN parameter_value_product pvp ON pv.id=pvp.parameter_value_id"),
    MYSQLI_ASSOC
);

$parameterToProductToParameterValue = [];

foreach ($pvpRows as $pvpItem) {
    if ($pvpItem['product_id']) {
        if (!array_key_exists($pvpItem['id'], $parameterToProductToParameterValue)) {
            $parameterToProductToParameterValue[$pvpItem['id']] = [];
        }
        
        $parameterToProductToParameterValue[$pvpItem['id']][$pvpItem['product_id']] = $pvpItem;
    }
}

$parameters = getParameters();

$summWithWat = null;

$wat = null;

if (array_key_exists('wat', $_GET)) {
    $wat = intval($_GET['wat']);
    
    mysqli_query($link, "SET @p0='$wat'"); 
    mysqli_query($link, "CALL `wat_summ`(@p0, @p1)"); 
    
	$summWithWat = mysqli_fetch_row(mysqli_query($link, "SELECT @p1"))[0];
}

include 'views' . DIRECTORY_SEPARATOR . '_header.phtml';

include 'views' . DIRECTORY_SEPARATOR . 'manage_products.phtml';

include 'views' . DIRECTORY_SEPARATOR . '_footer.phtml';