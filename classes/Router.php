<?php

class Router
{

    static function start()
    {

        $controller_name = 'main';
        $action_name = 'index';
        $params = array();

        $routes = explode('/', $_GET['url']);

        if (!empty($routes[0])) {
            $controller_name = $routes[0];
        }

        if (!empty($routes[1])) {
            $action_name = $routes[1];
        }

        for ($i = 2; $i < sizeof($routes); $i++) {
            $params[$i - 2] = $routes[$i];
        }

        $controller_name = strtolower($controller_name) . '_Controller';
        $action_name = strtolower($action_name) . 'Action';

        $controller_file = $controller_name . '.php';
        $controller_path = "controllers/" . $controller_file;
        if (!file_exists($controller_path)) {
            Router::ErrorPage404();

        }

        if (class_exists($controller_name)) {

            $controller = new $controller_name;
            $action = $action_name;
        }


        if (method_exists($controller, $action)) {

            $controller->$action($params);
        } else {
            Router::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
        echo 'error405';
        /*$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');*/
    }

}