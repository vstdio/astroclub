<?php
    class Comment
    {
        public static function getCommentsByArticleId($articleId)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT * FROM `comment` " .
                     "INNER JOIN `user` ON `comment`.`id_user` = `user`.`id_user` " .
                     "WHERE `id_article` = :articleId";
            $response = $dbLink->prepare($query);
            $response->bindParam(':articleId', $articleId, PDO::PARAM_INT);
            $response->setFetchMode(PDO::FETCH_ASSOC);
            $response->execute();

            $comments = array();
            while ($comment = $response->fetch())
            {
                $comments[] = $comment;
            }

            return $comments;
        }

        public static function getCommentCount($articleId)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT COUNT(*) AS `comment_count` FROM `comment` " .
                     "WHERE `comment`.`id_article` = {$articleId}";

            $response = $dbLink->query($query);
            return $response->fetch()["comment_count"];
        }

        public static function matchesContentRequirements($commentContent)
        {
            $len = strlen(utf8_decode($commentContent));
            return $len >= 2 && $len <= 100;
        }

        public static function add($content, $articleId, $userId)
        {
            $dbLink = Database::getInstance();

            $query = "INSERT INTO `comment` " .
                     "(`content`, `date`, `id_article`, `id_user`) " .
                     "VALUES (:content, NOW(), :articleId, :userId)";

            $response = $dbLink->prepare($query);
            $response->bindParam(':content', $content, PDO::PARAM_STR);
            $response->bindParam(':articleId', $articleId, PDO::PARAM_INT);
            $response->bindParam(':userId', $userId, PDO::PARAM_INT);

            return $response->execute();
        }
    }
