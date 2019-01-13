<?php
    require_once ROOT . "/components/Database.php";

    class Article
    {
        const DEFAULT_ITEMS_COUNT = 3;

        public static function getArticle($articleId)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT * FROM `article` " .
                     "INNER JOIN `user` ON `article`.`id_author` = `user`.`id_user` " .
                     "WHERE `id_article` = {$articleId}";
            $response = $dbLink->query($query);

            $response->setFetchMode(PDO::FETCH_ASSOC);
            $record = $response->fetch();

            return $record;
        }

        public static function getArticlesList($page = 1, $count = self::DEFAULT_ITEMS_COUNT)
        {
            $dbLink = Database::getInstance();

            $offset = ($page - 1) * $count;

            $query = "SELECT * FROM `article` " .
                     "INNER JOIN `user` ON `article`.`id_author` = `user`.`id_user` " .
                     "ORDER BY `id_article` DESC LIMIT {$count} OFFSET {$offset}";
            $response = $dbLink->query($query);

            $articles = array();
            while ($record = $response->fetch())
            {
                $articles[] = array(
                    "id_article" => $record["id_article"],
                    "title" => $record["title"],
                    "date" => $record["date"],
                    "short_content" => $record["short_content"],
                    "content" => $record["content"],
                    "preview" => $record["preview"],
                    "id_category" => $record["id_category"],
                    "id_author" => $record["id_author"],
                    "author_name" => $record["login"],
                    "comment_count" => Comment::getCommentCount($record["id_article"])
                );
            }

            return $articles;
        }

        public static function getArticlesTotalAmount()
        {
            $dbLink = Database::getInstance();

            $query = "SELECT COUNT(id_article) AS count FROM `article`";
            $response = $dbLink->query($query);

            $record = $response->fetch();
            return $record["count"];
        }

        public static function getLastArticles($count = self::DEFAULT_ITEMS_COUNT)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT * FROM `article` ORDER BY `id_article` DESC LIMIT {$count}";
            $response = $dbLink->query($query);

            $articles = array();

            while ($record = $response->fetch())
            {
                $articles[] = array(
                    "id_article" => $record["id_article"],
                    "title" => $record["title"]
                );
            }

            return $articles;
        }

        public static function getArticlesByCategory($categoryId, $count = self::DEFAULT_ITEMS_COUNT, $page = 1)
        {
            $dbLink = Database::getInstance();

            $offset = ($page - 1) * $count;
            $query = "SELECT * FROM `article` " .
                     "INNER JOIN `user` ON `article`.`id_author` = `user`.`id_user`" .
                     "WHERE `article`.`id_category` = {$categoryId} " .
                     "ORDER BY `article`.`id_article` DESC LIMIT {$count} OFFSET {$offset}";

            $response = $dbLink->query($query);
            $response->setFetchMode(PDO::FETCH_ASSOC);

            $articles = array();
            while ($record = $response->fetch())
            {
                $articles[] = array(
                    "id_article" => $record["id_article"],
                    "title" => $record["title"],
                    "date" => $record["date"],
                    "short_content" => $record["short_content"],
                    "content" => $record["content"],
                    "preview" => $record["preview"],
                    "id_category" => $record["id_category"],
                    "id_author" => $record["id_author"],
                    "author_name" => $record["login"],
                    "comment_count" => Comment::getCommentCount($record["id_article"])
                );
            }

            return $articles;
        }

        public static function GetArticlesTotalAmountByCategory($categoryId)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT COUNT(id_article) AS count FROM `article` " . 
                     "WHERE `id_category` = {$categoryId}";
            $response = $dbLink->query($query);

            $record = $response->fetch();
            return $record["count"];
        }

        public static function GetArticlesLikeSearchString($search, $limit = self::DEFAULT_ITEMS_COUNT)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT * FROM `article` WHERE `title` LIKE '%$search%' LIMIT {$limit}";
            $response = $dbLink->query($query);

            $articles = array();
            while ($record = $response->fetch())
            {
                $articles[] = array(
                    "id_article" => $record["id_article"],
                    "title" => $record["title"]
                );
            }

            return $articles;
        }

        /**
         * @param $title
         * @param $description
         * @param $content
         * @param $authorId
         * @param $categoryId
         * @return bool
         */
        public static function add($title, $description, $content, $authorId, $categoryId)
        {
            $dbLink = Database::getInstance();

            $query = "INSERT INTO `article` " .
                     "(`title`, `date`, `short_content`, `content`, `id_category`, `id_author`) " .
                     "VALUES (:title, NOW(), :description, :content, :categoryId, :authorId)";

            $response = $dbLink->prepare($query);
            $response->bindParam(':title', $title, PDO::PARAM_STR);
            $response->bindParam(':description', $description, PDO::PARAM_STR);
            $response->bindParam(':content', $content, PDO::PARAM_STR);
            $response->bindParam(':authorId', $authorId, PDO::PARAM_INT);
            $response->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);

            return $response->execute();
        }

        /**
         * Возвращает массив category_name -> count
         */
        public static function getStatistics()
        {
            $dbLink = Database::getInstance();

            $query = "SELECT category.name, COUNT(article.id_category) AS count FROM `article` " .
                     "INNER JOIN category ON category.id_category = article.id_category " .
                     "GROUP BY article.id_category ";

            $response = $dbLink->query($query);
            $response->setFetchMode(PDO::FETCH_ASSOC);

            $statistics = array();
            while ($record = $response->fetch())
            {
                $statistics[$record["name"]] = $record["count"];
            }

            return $statistics;
        }
    }
