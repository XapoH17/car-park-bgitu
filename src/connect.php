<?php
$host = 'localhost';
$user = 'AntonP';
$password = 'Vfhrbpjy00';
$db = 'avto_salon_vw';

$link = mysqli_connect($host, $user, $password, $db);

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с базой данных $db.";
    echo '<br>';    
    echo "Код ошибки errno: " . mysqli_connect_errno();
    echo '<br>';
    echo "Текст ошибки error: " . mysqli_connect_error();
    
    exit;
}