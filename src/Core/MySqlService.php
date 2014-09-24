<?php
/**
 * Author: Rottenwood
 * Date Created: 23.09.14 18:05
 */

namespace PetrAurora;

class MySqlService {

    public $mysqli;

    public function __construct() {
        $this->mysqli = new \mysqli("localhost", "petr", "inelep", "aurora");

        // Проверка соединения
        if (mysqli_connect_errno()) {
            printf("Ошибка соединения: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function checkUser($name, $password) {
        $token = null;

        // Шифрование пароля
        $password = md5($password);

        if ($stmt = $this->mysqli->prepare("SELECT token FROM users WHERE name = ? AND password = ?")) {

            $stmt->bind_param('ss', $name, $password);
            $stmt->execute();
            $stmt->bind_result($token);
            $stmt->fetch();

            $stmt->close();
        }

        $this->mysqli->close();

        return $token;
    }

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

        $this->mysqli->close();

        if (!is_null($tokenInDb) && $tokenLocal == $tokenInDb) {
            return true;
        } else {
            return false;
        }
    }

    public function getUsers() {
        $user = null;
        $users = array();

        if ($stmt = $this->mysqli->prepare("SELECT name FROM users")) {

            $stmt->execute();
            $stmt->bind_result($user);

            // Запись всех полученных имен пользователей в общий массив
            while ($stmt->fetch()) {
                $users[] = $user;
            }

            $stmt->close();
        }

        $this->mysqli->close();

        if (!is_null($users)) {
            return $users;
        } else {
            return false;
        }
    }

    public function getPages() {
        $pages = array();

        if ($stmt = $this->mysqli->prepare("SELECT p.id, p.title, p.alias FROM pages p LEFT JOIN pics i ON p.pic_id = i.id")) {

            $stmt->execute();
            $stmt->bind_result($id, $title, $alias);

            // Запись всех полученных имен пользователей в общий массив
            while ($stmt->fetch()) {
                $pages[$id]['title'] = $title;
                $pages[$id]['alias'] = $alias;

            }

            $stmt->close();
        }

        $this->mysqli->close();

        if (!is_null($pages)) {
            return $pages;
        } else {
            return false;
        }
    }

    public function getPageByAlias($alias) {
        $page = array();

        if ($stmt = $this->mysqli->prepare("SELECT p.id, p.title, p.content, p.alias, i.pic FROM pages p LEFT JOIN pics i ON p.pic_id = i.id WHERE p.alias = ?")) {

            $stmt->bind_param('s', $alias);
            $stmt->execute();
            $stmt->bind_result($id, $title, $content, $alias, $pic);

            // Запись всех полученных имен пользователей в общий массив
            while ($stmt->fetch()) {
                $page['id'] = $id;
                $page['title'] = $title;
                $page['alias'] = $alias;
                $page['content'] = $content;
                $page['pic'] = 'data:image/jpeg;base64,' . base64_encode($pic);
            }

            $stmt->close();
        }

        $this->mysqli->close();

        return $page;
    }

    public function deletePage($id) {
        $stmt = $this->mysqli->prepare("DELETE FROM pages WHERE id = ?");
        $stmt->bind_param('d', $id);
        $stmt->execute();
        $stmt->close();

        if ($stmt->affected_rows) {
            $return = true;
        } else {
            $return = false;
        }

        $this->mysqli->close();

        return $return;
    }

}