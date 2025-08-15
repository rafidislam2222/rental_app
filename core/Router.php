<?php
class Router {
    public function run() {
        // Break the URL into parts: Controller / Method / Params
        $url = isset($_GET['url']) 
            ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) 
            : ['HomeController', 'index'];

        $controllerName = $url[0] ?? 'HomeController';
        $methodName = $url[1] ?? 'index';
        $params = array_slice($url, 2); // Everything after controller & method

        // Load the controller file
        $controllerFile = "../app/controllers/" . $controllerName . ".php";
        if (!file_exists($controllerFile)) {
            die("Controller file not found: " . $controllerFile);
        }
        require_once $controllerFile;

        // Create the controller instance
        if (!class_exists($controllerName)) {
            die("Controller class not found: " . $controllerName);
        }
        $controller = new $controllerName();

        // Check if method exists
        if (!method_exists($controller, $methodName)) {
            die("Method '$methodName' not found in controller '$controllerName'");
        }

        // Call the method with or without parameters
        if (!empty($params)) {
            call_user_func_array([$controller, $methodName], $params);
        } else {
            $controller->$methodName();
        }
    }
}
?>
