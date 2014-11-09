<?php

class Database_Model
{
    /*
     *      Функция для подключения к базе данных.
     */
    public function dbConnect($db_location, $db_name, $mysql_user, $mysql_password)
    {
        $link = mysql_connect($db_location, $mysql_user, $mysql_password);
        if (!$link) {
            die('Ошибка соединения: ' . mysql_error());
        }
        echo 'Успешно соединились!';
        //mysql_close($link);
    }

    /**
     *      Функция подключения к базе данных с использованием PDO
     */
    public function pdoDbConnect ($dsn, $user, $password)
    {
        // код генерирующий исключение
        try {
            $dbh = new PDO($dsn, $user, $password);
            echo 'Успешно соеденились с БД!';
            // перехват исключения
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }
}
