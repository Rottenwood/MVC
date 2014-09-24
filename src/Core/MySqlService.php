<?php
/**
 * Author: Rottenwood
 * Date Created: 23.09.14 18:05
 */

namespace PetrAurora;

/**
 * Класс общих запросов к БД
 * @package PetrAurora
 */
class MySqlService {

    public $mysqli;

    public function __construct() {
        $this->mysqli = new \mysqli(Parameters::$hostname, Parameters::$username, Parameters::$password, Parameters::$database);

        // Проверка соединения
        if (mysqli_connect_errno()) {
            printf("Ошибка соединения: %s\n", mysqli_connect_error());
            exit();
        }
    }

    /**
     * Проверка имени и пароля пользователя
     * @param $name
     * @param $password
     * @return null
     */
    public function checkUser($name, $password) {
        $id = null;

        // Шифрование пароля
        $password = md5($password);

        if ($stmt = $this->mysqli->prepare("SELECT id FROM users WHERE name = ? AND password = ?")) {

            $stmt->bind_param('ss', $name, $password);
            $stmt->execute();
            $stmt->bind_result($id);
            $stmt->fetch();

            $stmt->close();
        }

        return $id;
    }

    public function setToken($id, $token) {
        // Обновление записи в БД
        $stmt = $this->mysqli->prepare("UPDATE users SET token = ? WHERE id = ?");
        $stmt->bind_param('ss', $token, $id);
        $stmt->execute();
        $stmt->close();

        return $token;
    }

    /**
     * Проверка токена (авторизован ли пользователь)
     * @param $tokenArray
     * @return bool
     */
    public function checkToken($tokenArray) {
        $user = $tokenArray['user'];
        $tokenLocal = $tokenArray['token'];
        $tokenInDb = null;

        if ($stmt = $this->mysqli->prepare("SELECT token FROM users WHERE name = ?")) {

            $stmt->bind_param('s', $user);
            $stmt->execute();
            $stmt->bind_result($tokenInDb);
            $stmt->fetch();

            $stmt->close();
        }

        if (!is_null($tokenInDb) && $tokenLocal == $tokenInDb) {
            return true;
        } else {
            return false;
        }
    }
}
