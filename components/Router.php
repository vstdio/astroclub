<?php
    require_once ROOT . "/controllers/HomeController.php";

    class Router
    {
        private $routes;

        public function __construct($routes)
        {
            $this->routes = $routes;
        }

        public function run($uri)
        {
            foreach ($this->routes as $pattern => $path)
            {
                if (preg_match("$pattern", $uri))
                {
                    $params = explode("/", $path);
                    $controller = ucfirst(array_shift($params) . "Controller");
                    $action = array_shift($params);
                    call_user_func_array(array(new $controller(), $action), $params);
                    break;
                }
            }
        }
    }
