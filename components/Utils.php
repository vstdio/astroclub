<?php
    class Utils
    {
        /**
         * @return string
         * @throws Exception
         */
        public static function getUri()
        {
            $uri = $_SERVER['REQUEST_URI'];
            if (!empty($uri))
            {
                return trim($uri, "/");
            }
            throw new Exception("uri is empty");
        }

        public static function prettyPrint($value)
        {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        }
    }
