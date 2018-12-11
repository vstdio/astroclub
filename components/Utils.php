<?php
    class Utils
    {
        public static function getRequestUri()
        {
            return trim($_SERVER['REQUEST_URI'], '/');
        }

        public static function prettyPrint($value)
        {
            echo "<pre>";
            echo print_r($value);
            echo "</pre>";
        }
    }
