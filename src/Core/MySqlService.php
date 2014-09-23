<?php
/**
 * Author: Rottenwood
 * Date Created: 23.09.14 18:05
 */

namespace PetrAurora;

class MySqlService {

    // Соединение с БД
    public function dbconnect() {
        $connections = mysql_connect($this->hostname_logon, $this->username_logon, $this->password_logon) or die ('Unabale to connect to the database');
        mysql_select_db($this->database_logon) or die ('Unable to select database!');
        return;
    }
} 