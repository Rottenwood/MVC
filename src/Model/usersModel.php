<?php
namespace PetrAurora\Model;

/**
 * Модель для работы с пользователями
 * @package PetrAurora\Model
 */
class usersModel extends Model {

    /**
     * Получение списка всех пользователей
     * @return array|bool
     */
    public function getAllUsers() {
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

        if (!is_null($users)) {
            return $users;
        } else {
            return false;
        }
    }
}
