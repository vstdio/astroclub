<?php
    class CabinetController
    {
        public function index()
        {
            if (!User::isLogged())
            {
                header("Location: /user/login");
            }

            $lastArticles = Article::getLastArticles(5);
            $categoriesList = Category::GetCategoriesList();

            $user = User::getById($_SESSION['user']);

            require_once ROOT . "/views/cabinet/index.php";
            return true;
        }

        public function edit()
        {
            if (!User::isLogged())
            {
                header("Location: /user/login");
            }

            $lastArticles = Article::getLastArticles(5);
            $categoriesList = Category::GetCategoriesList();

            $email = "";
            $password = "";
            $passwordConfirm = "";
            $phoneNumber = "";

            $errors = array();
            $edited = array();

            if (isset($_POST['submit']))
            {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $passwordConfirm = $_POST['password_confirm'];
                $phoneNumber = $_POST['phone'];

                if (!empty($email))
                {
                    if (!User::matchesEmail($email))
                    {
                        $errors['email'] = "Некорректный e-mail";
                    }
                    else if (User::emailExists($email))
                    {
                        $errors['email'] = "Такой e-mail уже зарегистрирован на сайте";
                    }
                    else if (User::updateEmail($_SESSION['user'], $email))
                    {
                        $edited['email'] = "E-mail был изменён";
                    }
                }

                if (!empty($password))
                {
                    if (!User::matchesPassword($password))
                    {
                        $errors['password'] = "Некорректный пароль";
                    }
                    else if ($password != $passwordConfirm)
                    {
                        $errors['password'] = "Пароли не совпадают";
                    }
                    else if (User::updatePassword($_SESSION['user'], $password))
                    {
                        $edited['password'] = "Пароль был изменён";
                    }
                }

                if (!empty($phoneNumber))
                {
                    if (!User::matchesPhone($phoneNumber))
                    {
                        $errors['phone'] = "Неверно указан номер телефона";
                    }
                    else if (User::updatePhone($_SESSION['user'], $phoneNumber))
                    {
                        $edited['phone'] = "Телефон был изменён";
                    }
                }

                if (empty($edited))
                {
                    $errors['other'] = "Заполните хотя бы одно поле";
                }
            }

            require_once ROOT . "/views/cabinet/edit.php";
        }

        public function add()
        {
            if (!User::isLogged())
            {
                header("Location: /user/login");
            }

            $lastArticles = Article::getLastArticles(5);
            $categoriesList = Category::GetCategoriesList();

            $userId = $_SESSION['user'];

            $user = User::getById($userId);
            $added = false;

            if (isset($_POST['submit']))
            {
                $category = $_POST['category'];
                $title = $_POST['title'];
                $content = $_POST['content'];
                $added = Article::add($title, 'Краткое содержание статьи...', $content, $user['id_user'], $category);
            }

            require_once ROOT . "/views/article/add.php";
        }
    }
