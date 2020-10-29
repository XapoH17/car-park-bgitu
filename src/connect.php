<?php
/**
 * Reading env file
 */

if (file_exists($envFilePath)) {
    $envFileContent = file_get_contents($envFilePath);

    $envFileLines = explode(PHP_EOL, $envFileContent);

    $needOptions = 4;

    $passOptions = [];

    foreach ($envFileLines as $config) {
        if (strpos($config, '=') !== false) {
            $key = explode('=', $config)[0];

            $value = explode('=', $config)[1];

            $passOptions = array_unique($passOptions);

            switch ($key) {
                case 'DB_HOST':
                    $dbHost = $value;

                    $passOptions[] = $key;
                    break;
                case 'DB_NAME':
                    $dbName = $value;

                    $passOptions[] = $key;
                    break;
                case 'DB_USER':
                    $dbUser = $value;

                    $passOptions[] = $key;
                    break;
                case 'DB_PASS':
                    $dbPass = $value;

                    $passOptions[] = $key;
                    break;
            }
        }
    }

    if (count($passOptions) != $needOptions) {
        throw new Error('Does not have config options for setup database connection');
    }

    unset($envFileContent, $envFileLines, $needOptions, $passOptions, $config, $key, $value);
} else {
    $dbHost = 'localhost';
    $dbName = 'avto_salon_vw';
    $dbUser = 'AntonP';
    $dbPass = 'Vfhrbpjy00';
}

$link = mysqli_connect($dbHost, $dbName, $dbUser, $dbPass);

unset($dbPass);

if (!$link) {
    echo 'Ошибка: Невозможно установить соединение с базой данных ' . $dbHost . '.' . $dbName;
    echo '<br>';    
    echo 'Код ошибки errno: ' . mysqli_connect_errno();
    echo '<br>';
    echo 'Текст ошибки error: ' . mysqli_connect_error();
    
    exit;
}