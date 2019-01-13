<?php
    require_once ROOT . "/controllers/ArticleController.php";
    require_once ROOT . "/controllers/CabinetController.php";
    require_once ROOT . "/controllers/HomeController.php";
    require_once ROOT . "/controllers/UserController.php";

    class Router
    {
        private $routes = null;

        public function __construct($routes)
        {
            $this->routes = $routes;
        }

        public function run($uri)
        {
            foreach ($this->routes as $pattern => $route)
            {
                if (preg_match($pattern, $uri))
                {
                    $params = explode("/", preg_replace($pattern, $route, $uri));
                    $controller = ucfirst(array_shift($params) . "Controller");
                    $action = array_shift($params);
                    call_user_func_array(array(new $controller, $action), $params);
                    return;
                }
            }
            header("Location: /404");
        }
    }
