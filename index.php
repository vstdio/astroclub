<?php
    define("ROOT", dirname(__FILE__));
    require_once ROOT . "/components/Router.php";
    require_once ROOT . "/components/Utils.php";
    require_once ROOT . "/config/routes.php";

    function configure()
    {
        ini_set("display_errors", 1);
        error_reporting(E_ALL);
    }

    function main()
    {
        try
        {
            configure();
            $router = new Router(getRoutes());
            $router->run(Utils::getUri());
        }
        catch (Exception $ex)
        {
            echo("FATAL ERROR: " . $ex->getMessage());
            exit(1);
        }
    }

    main();
