<?php
    require_once ROOT . "/components/Database.php";

    class Category
    {
        public static function GetCategoriesList()
        {
            $dbLink = Database::getInstance();

            $query = "SELECT * FROM `category`";
            $response = $dbLink->query($query);

            $categories = array();

            while ($record = $response->fetch())
            {
                $categories[] = array(
                    "id_category" => $record["id_category"],
                    "name" => $record["name"]
                );
            }

            return $categories;
        }
    }
