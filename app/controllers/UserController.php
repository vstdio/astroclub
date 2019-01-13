<?php
    class UserController
    {
        public function register()
        {
            $login = "";
            $email = "";
            $password = "";
            $passwordConfirm = "";
            $registered = false;

            if (isset($_POST['submit']))
            {
                $login = $_POST['login'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $passwordConfirm = $_POST['password_confirm'];

                $errors = array();

                if (!User::matchesLogin($login))
                {
                    $errors[] = "Логин должен начинаться с буквы, минимальная длина - 6 символов";
                }
                if (!User::matchesEmail($email))
                {
                    $errors[] = "Неправильный email";
                }
                if (!User::matchesPassword($password))
                {
                    $errors[] = "Пароль должен быть не короче 6 символов";
                }
                if ($password != $passwordConfirm)
                {
                    $errors[] = "Пароли не совпадают";
                }
                if (User::emailExists($email))
                {
                    $errors[] = "Такой email уже используется";
                }
                if (User::loginExists($login))
                {
                    $errors[] = "Пользователь с таким логином уже существует";
                }

                if (empty($errors))
                {
                    $registered = User::register($login, $email, $password);
                }
            }

            $lastArticles = Article::getLastArticles(5);
            $categoriesList = Category::GetCategoriesList();
            require_once ROOT . "/views/user/register.php";
            return true;
        }

        public function login()
        {
            $lastArticles = Article::getLastArticles(5);
            $categoriesList = Category::GetCategoriesList();

            $login = "";
            $password = "";
            $errors = array();
            $authorized = false;

            if (isset($_POST["submit"]))
            {
                $login = $_POST["login"];
                $password = $_POST["password"];

                if (!User::matchesLogin($login) || !User::matchesPassword($password))
                {
                    $errors[] = "Неправильно введены данные для входа";
                }
                elseif ($userId = User::getId($login, $password))
                {
                    User::auth($userId);
                    $authorized = true;
                }
                else
                {
                    $errors[] = "Пользователя с такой комбинацией логина и пароля не существует";
                }
            }

            require_once ROOT . "/views/user/login.php";
            return true;
        }

        public function logout()
        {
            User::logout();
            header("Location: /");
        }

        public function view($id)
        {
            $lastArticles = Article::getLastArticles(5);
            $categoriesList = Category::GetCategoriesList();
            $user = User::getById($id);
            $userPostCount = User::getPostCount($id);
            $userCommentCount = User::getCommentCount($id);
            require_once ROOT . "/views/user/view.php";
        }
    }
