<?php
if (is_file('config.php')) {
    require_once('config.php');
}

//определяем в UTF-8 входные и выходные данные из HTTP-запросов
mb_http_input('UTF-8');
mb_http_output('UTF-8');
//устанавливаем UTF-8 для работы со строками
mb_internal_encoding("UTF-8");

function __autoload($class)
{
    $path = "classes/{$class}.php";
    if (is_file($path))
        include_once($path);
    $path = "models/{$class}.php";
    if (is_file($path)){
        include_once($path);
    }
    $path="controllers/{$class}.php";
    if (is_file($path)){
        include_once($path);
    }


}

DataBase::Connect();
Session::init();
Router::start();
