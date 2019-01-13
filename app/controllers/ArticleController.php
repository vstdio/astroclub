<?php
    require_once ROOT . "/models/Comment.php";
    require_once ROOT . "/models/User.php";

    class ArticleController
    {
        public function view($articleId)
        {
            $article = Article::getArticle($articleId);
            if ($article === false)
            {
                header("Location: /404");
            }
            $comments = Comment::getCommentsByArticleId($articleId);
            $lastArticles = Article::getLastArticles(5);
            $categoriesList = Category::GetCategoriesList();

            $errors = array();
            if (isset($_POST["submit"]) && User::isLogged())
            {
                $commentContent = $_POST["content"];
                if (Comment::matchesContentRequirements($commentContent))
                {
                    if (Comment::add(htmlspecialchars($commentContent), $articleId, $_SESSION["user"]))
                    {
                        header("Location: /articles/" . $articleId);
                    }
                    else
                    {
                        $errors[] = "Возникла неизвестная ошибка";
                    }
                }
                else
                {
                    $errors[] = "Допустимый размер комментария: от 1 до 100 символов!";
                }
            }

            require_once ROOT . "/views/article/view.php";
        }

        public function category($categoryId, $page = 1)
        {
            $articles = Article::getArticlesByCategory($categoryId, Article::DEFAULT_ITEMS_COUNT, $page);
            $lastArticles = Article::getLastArticles(5);
            $totalAmount = Article::GetArticlesTotalAmountByCategory($categoryId);
            $pagination = new Pagination($totalAmount, $page, Article::DEFAULT_ITEMS_COUNT, "pages/");
            $categoriesList = Category::GetCategoriesList();
            require_once ROOT . "/views/main/index.php";
        }
    }
