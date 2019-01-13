<?php
    class User
    {
        /**
         * Регистрирует пользователя с заданными параметрами,
         * возвращает статус успеха операции
         * @param string $login
         * @param string $email
         * @param string $password
         * @return bool
         */
        public static function register($login, $email, $password)
        {
            $dbLink = Database::getInstance();

            $query = "INSERT INTO `user` (login, email, password, registration_date) " .
                     "VALUES (:login, :email, :password, NOW())";

            $response = $dbLink->prepare($query);
            $response->bindParam(':login', $login, PDO::PARAM_STR);
            $response->bindParam(':email', $email, PDO::PARAM_STR);

            $hashedPassword = md5($password);
            $response->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

            return $response->execute();
        }

        /**
         * Проверяем логин на соответствие требованиям.
         * Возращает true, если логин соответствует требованиям, иначе false.
         * @param string $login
         * @return boolean
         */
        public static function matchesLogin($login)
        {
            $regex = "/[a-zA-Z][_a-zA-Z0-9]{5,}/";
            return preg_match($regex, $login);
        }

        /**
         * Проверяем пароль на соответствие требованиям.
         * Возвращает true, если пароль соответствует требованиям, иначе false.
         * @param string $password
         * @return boolean
         */
        public static function matchesPassword($password)
        {
            return strlen($password) >= 6;
        }

        /**
         * Проверяем номер телефона на соответствие требованиям.
         * Возвращает true, если номер телефона соответствует требованиям, иначе false.
         * @param string $phone
         * @return boolean
         */
        public static function matchesPhone($phone)
        {
            $regex = "~^\\+\\d (\\d\\d\\d) \\d\\d\\d \\d\\d-\\d\\d/$~";
            return preg_match($regex, $phone);
        }

        /**
         * Проверяем email на соответствие требованиям.
         * Возвращает true, если пароль соответствует требованиям, иначе false.
         * @param string $email
         * @return boolean
         */
        public static function matchesEmail($email)
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        /**
         * Проверяет, существует ли в БД пользователь с данным email.
         * Возвращает true, если пользователь с данными email существует, иначе false.
         * @param $email
         * @return boolean
         */
        public static function emailExists($email)
        {
            $dbLink = Database::getInstance();
            $query = "SELECT COUNT(*) FROM `user` WHERE `email` = :email";

            $result = $dbLink->prepare($query);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->execute();

            $count = intval($result->fetchColumn());
            return $count >= 1;
        }

        /**
         * Проверяет, существует ли в БД пользователь с данным логином
         * Возвращает true, если пользователь с данными логином существует, иначе false.
         * @param $login
         * @return boolean
         */
        public static function loginExists($login)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT COUNT(*) FROM `user` WHERE `login` = :login";
            $response = $dbLink->prepare($query);

            $response->bindParam(':login', $login, PDO::PARAM_STR);
            $response->execute();

            $count = intval($response->fetchColumn());
            return $count >= 1;
        }

        /**
         * Возвращает идентификатор пользователя в БД, если такой существует, иначе false.
         * @param $login string
         * @param $password string
         * @return mixed
         */
        public static function getId($login, $password)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT * FROM `user` WHERE `login` = :login AND `password` = :password";

            $response = $dbLink->prepare($query);
            $response->bindParam(':login', $login, PDO::PARAM_STR);

            $hashedPassword = md5($password);
            $response->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $response->execute();

            if ($user = $response->fetch())
            {
                return $user['id_user'];
            }
            return false;
        }

        /**
         * Возвращает данные о пользователе по индентификатору
         * @param $id integer
         * @return array
         */
        public static function getById($id)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT * FROM `user` WHERE `id_user` = :id";
            $response = $dbLink->prepare($query);
            $response->bindParam(':id', $id, PDO::PARAM_INT);
            $response->setFetchMode(PDO::FETCH_ASSOC);
            $response->execute();

            return $response->fetch();
        }

        /**
         * Возвращает кол-во оставленных комментариев на сайте
         * @param $id
         * @return int
         */
        public static function getCommentCount($id)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT COUNT(*) AS count FROM `comment` " .
                     "WHERE `comment`.`id_user` = :id";
            $response = $dbLink->prepare($query);
            $response->bindParam(':id', $id, PDO::PARAM_INT);
            $response->setFetchMode(PDO::FETCH_ASSOC);
            $response->execute();

            return intval($response->fetch()["count"]);
        }

        /**
         * Возвращает кол-во опубликованных на сайте статей пользователем
         * @param $id
         * @return int
         */
        public static function getPostCount($id)
        {
            $dbLink = Database::getInstance();

            $query = "SELECT COUNT(*) AS count FROM `article` " .
                     "WHERE `article`.`id_author` = :id";

            $response = $dbLink->prepare($query);
            $response->bindParam(':id', $id, PDO::PARAM_INT);
            $response->setFetchMode(PDO::FETCH_ASSOC);
            $response->execute();

            return intval($response->fetch()["count"]);
        }

        /**
         * Изменяет поле email пользователя с заданным id
         * @param $id
         * @param $email
         * @return bool
         */
        public static function updateEmail($id, $email)
        {
            $dbLink = Database::getInstance();

            $query = "UPDATE `user` SET `email` = :email WHERE `id_user` = :id";
            $response = $dbLink->prepare($query);
            $response->bindParam(':id', $id, PDO::PARAM_INT);
            $response->bindParam(':email', $email, PDO::PARAM_STR);

            return $response->execute();
        }

        /**
         * Изменяет поле пароль пользователя с заданным id
         * @param $id
         * @param $password
         * @return bool
         */
        public static function updatePassword($id, $password)
        {
            $dbLink = Database::getInstance();

            $query = "UPDATE `user` SET `password` = :password WHERE `id_user` = :id";
            $response = $dbLink->prepare($query);
            $response->bindParam(':id', $id, PDO::PARAM_INT);
            $hashedPassword = md5($password);
            $response->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

            return $response->execute();
        }

        /**
         * Изменяет поле телефон пользователя с заданным id
         * @param $id
         * @param $phoneNumber
         * @return bool
         */
        public static function updatePhone($id, $phoneNumber)
        {
            $dbLink = Database::getInstance();

            $query = "UPDATE `user` SET `phone_number` = :phone WHERE `id_user` = :id";
            $response = $dbLink->prepare($query);
            $response->bindParam(':id', $id, PDO::PARAM_INT);
            $response->bindParam(':phone', $phoneNumber, PDO::PARAM_STR);

            return $response->execute();
        }

        /**
         * Запоминает идентификатор пользователя в сессии
         * @param $id
         * @return void
         */
        public static function auth($id)
        {
            $_SESSION['user'] = $id;
        }

        /**
         * Проверяет, авторизован ли пользователь на сайте
         * @return boolean
         */
        public static function isLogged()
        {
            return isset($_SESSION['user']);
        }

        /**
         * Удаляет данные о пользователе из сессии
         * @return void
         */
        public static function logout()
        {
            unset($_SESSION['user']);
        }
    }
