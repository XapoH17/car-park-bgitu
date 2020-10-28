<?php
session_start();

const VIEWS_DIR = 'views'  . DIRECTORY_SEPARATOR;

$basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR;

require_once $basePath . 'connect.php';

require_once $basePath . 'validators.php';

$flash = null;

if (array_key_exists('flash', $_SESSION)) {
    $flash = $_SESSION['flash'];
}

$user = null;

function auth($login, $pass) {
    global $user, $link;

    $login = mysqli_real_escape_string($link, $login);
    $pass = mysqli_real_escape_string($link, $pass);
    
    $sql  =  "SELECT * FROM `users` where `login`='$login' and `password` = '$pass'";
    
    $result = mysqli_query($link, $sql);
    
    if (!mysqli_num_rows($result)) {
        $_SESSION['flash'] = 'Неверный логин или пароль!';
        
        return false;
    } else {
        $user = mysqli_fetch_object($result);
        
        $_SESSION['login'] = $login;
        
        $_SESSION['pass'] = $pass;
    }

    return true;
}

function isAuth() {
    global $user;
    
    if (array_key_exists('login', $_SESSION) && array_key_exists('pass', $_SESSION)) {
        return auth($_SESSION['login'], $_SESSION['pass']);
    }

    return false;
}

function checkAuth() {
    if (!isAuth()) {
        header('Location: /admin/');
    }
}

function clearFlash() {
    unset($_SESSION['flash']);
}

function getParameters() {
    global $link;
    
    $parametersAssoc = mysqli_fetch_all(mysqli_query($link, "SELECT * FROM parameters"), MYSQLI_ASSOC);

    $prametersId = [];
    
    $parametersByKeys = [];

    foreach ($parametersAssoc as $parameterItem) {
        $parameter = new ArrayObject($parameterItem, ArrayObject::ARRAY_AS_PROPS);

        $parametersId[] = $parameter->id;

        $parametersByKeys[$parameter->id] = $parameter;
    }

    $parameterValues = mysqli_fetch_all(
        mysqli_query($link, "SELECT * FROM parameter_values WHERE parameter_id IN (" . implode(',', $parametersId) . ")"),
        MYSQLI_ASSOC
    );

    foreach ($parameterValues as $parameterValue) {
        $parameter = $parametersByKeys[$parameterValue['parameter_id']];

        if (!isset($parameter->values)) {
            $parameter->values = [];
        }

        $parameter->values[] = $parameterValue;
    }

    return $parametersByKeys;
}

function renderTemplate($fileName = '', $data = []) {
    include VIEWS_DIR . '_header.phtml';
    
    extract($data);
    
    if ($fileName) {
        ob_start();
        
        $filePath = VIEWS_DIR . basename($fileName) . '.phtml';
        
        if (!file_exists($filePath)) {
            throw new Error('File of template not exists: ' . $filePath);
        }
        
        include $filePath;
        
        $page = ob_get_clean();
    }
    
    include VIEWS_DIR . 'layout.phtml';
    
    include VIEWS_DIR . '_footer.phtml';
}
