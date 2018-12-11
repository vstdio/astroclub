<?php
    require_once ROOT . "/config/database.php";

    class Database
    {
        private static $dbLink = null;

        private static $params = array(
            "DB_HOST" => DB_HOST,
            "DB_USER" => DB_USER,
            "DB_PASS" => DB_PASS,
            "DB_NAME" => DB_NAME
        );

        public static function getInstance()
        {
            if (self::$dbLink === null)
            {
                self::connect();
            }
            return self::$dbLink;
        }

        private static function connect()
        {
            $host = self::$params["DB_HOST"];
            $name = self::$params["DB_NAME"];

            $settings = "mysql:host={$host};dbname={$name}";

            try
            {
                self::$dbLink = new PDO($settings, self::$params["DB_USER"], self::$params["DB_PASS"]);
                self::$dbLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$dbLink->query("SET NAMES utf8");
            }
            catch (PDOException $ex)
            {
                exit($ex->getMessage());
            }
        }
    }
