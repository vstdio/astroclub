<?php
    require_once ROOT . "/components/Utils.php";
    require_once ROOT . "/components/Pagination.php";
    require_once ROOT . "/models/Article.php";
    require_once ROOT . "/models/Category.php";

    class HomeController
    {
        public function index($page = 1)
        {
            $totalAmount = Article::getArticlesTotalAmount();
            $pagination = new Pagination($totalAmount, $page, Article::DEFAULT_ITEMS_COUNT, "pages/");

            if (($page > $pagination->amount()) && ($pagination->amount() != 0))
            {
                header("Location: /404");
            }

            $articles = Article::getArticlesList($page, Article::DEFAULT_ITEMS_COUNT);

            $lastArticles = Article::getLastArticles(5);
            $categoriesList = Category::GetCategoriesList();
            require_once ROOT . '/views/main/index.php';
        }

        public function contact()
        {
            $categoriesList = Category::GetCategoriesList();
            $lastArticles = Article::getLastArticles(5);

            $send = false;
            $errors = array();

            $userEmail = "";
            $message = "";

            if (isset($_POST['submit']))
            {
                $userEmail = $_POST['email'];
                $message = $_POST['message'];

                if (!User::matchesEmail($userEmail))
                {
                    $errors[] = "Неправильно введён email";
                }
                if (strlen($message) < 12)
                {
                    $errors[] = "Текст сообщения должен иметь длину как минимум 12 символов";
                }

                if (empty($errors))
                {
                    // $to = "chosti34@gmail.com";
                    // $subject = "[chosty.ru] Письмо от пользователя сайта";
                    // $text = "Текст:\n" . $message . "\nОт: " . $userEmail;
                    // $headers = "From: {$userEmail}";
                    // $send = mail($to, $subject, $text, $headers);
                    // if (!$send)
                    {
                        $errors[] = "Сообщение не может быть отправлено. Повторите позднее.";
                    }
                }
            }

            require_once ROOT . "/views/main/contacts.php";
        }

        public function about()
        {
            $categoriesList = Category::GetCategoriesList();
            $lastArticles = Article::getLastArticles(5);
            $statistics = Article::getStatistics();
            require_once ROOT . "/views/main/about.php";
        }

        public function search()
        {
            // TODO: assert that index query is defined when entering this method!
            if (!isset($_GET['query']))
            {
                echo 'Error while receiving get query';
            }

            $query = trim(htmlspecialchars($_GET["query"]));
            // TODO: implement this
            $articles = array();

            $categoriesList = Category::GetCategoriesList();
            $lastArticles = Article::getLastArticles(5);

            if (strlen($query) < 128)
            {
                $articles = Article::GetArticlesLikeSearchString($query, 5);
            }

            require_once ROOT . "/views/main/search.php";
        }

        public function nfound()
        {
            http_response_code(404);
            $categoriesList = Category::GetCategoriesList();
            $lastArticles = Article::getLastArticles(5);
            require_once ROOT . "/views/main/404.php";
        }
    }
