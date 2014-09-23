<?php
namespace PetrAurora;

class loginService {
    // Реквизиты доступа к БД
    public $hostname_logon = 'localhost';
    public $database_logon = 'aurora';
    public $username_logon = 'petr';
    public $password_logon = 'inelep';

    // Поля в БД
    public $user_table = 'users';          //Users table name
    public $user_column = 'useremail';     //USERNAME column (value MUST be valid email)
    public $pass_column = 'password';      //PASSWORD column

    // MD5-хеширование пароля
    public $encrypt = true;

    // Соединение с БД
    public function dbconnect() {
        $connections = mysql_connect($this->hostname_logon, $this->username_logon, $this->password_logon) or die ('Unabale to connect to the database');
        mysql_select_db($this->database_logon) or die ('Unable to select database!');
        return;
    }

    // Логин
    public function login($table, $username, $password) {
        $this->dbconnect();

        if ($this->user_table == "") {
            $this->user_table = $table;
        }

        if ($this->encrypt == true) {
            $password = md5($password);
        }

        // Запрос на получение юзера через функцию защиты от SQL-инъекций
        $result = $this->qry("SELECT * FROM " . $this->user_table . " WHERE " . $this->user_column . "='?' AND " . $this->pass_column . " = '?';", $username, $password);
        $row = mysql_fetch_assoc($result);
        if ($result != "Error") {
            if ($row[$this->user_column] != "" && $row[$this->pass_column] != "") {
                // Открытие сессии после авторизации
                $_SESSION['loggedin'] = $row[$this->pass_column];
                return true;
            } else {
                session_destroy();
                return false;
            }
        } else {
            return false;
        }

    }

    // Функция защиты от SQL-инъекций
    public function qry($query) {
        $this->dbconnect();
        $args = func_get_args();
        $query = array_shift($args);
        $query = str_replace("?", "%s", $query);
        $args = array_map('mysql_real_escape_string', $args);
        array_unshift($args, $query);
        $query = call_user_func_array('sprintf', $args);
        $result = mysql_query($query) or die(mysql_error());
        if ($result) {
            return $result;
        } else {
            $result = 'Error';
            return $result;
        }
    }

    // Логаут
    public function logout() {
        session_destroy();
        return;
    }

    // Проверка состояния логина в системе
    public function logincheck($logincode, $user_table, $pass_column, $user_column) {
        $this->dbconnect();

        if ($this->pass_column == "") {
            $this->pass_column = $pass_column;
        }
        if ($this->user_column == "") {
            $this->user_column = $user_column;
        }
        if ($this->user_table == "") {
            $this->user_table = $user_table;
        }

        $result = $this->qry("SELECT * FROM " . $this->user_table . " WHERE " . $this->pass_column . " = '?';", $logincode);
        $rownum = mysql_num_rows($result);

        // Возвращаю true, если пользователь залогинен и false - если нет
        if ($result != "Error") {
            if ($rownum > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Сброс пароля
    public function passwordreset($username, $user_table, $pass_column, $user_column) {
        $this->dbconnect();
        $newpassword = $this->createPassword();

        if ($this->pass_column == "") {
            $this->pass_column = $pass_column;
        }
        if ($this->user_column == "") {
            $this->user_column = $user_column;
        }
        if ($this->user_table == "") {
            $this->user_table = $user_table;
        }

        if ($this->encrypt == true) {
            $newpassword_db = md5($newpassword);
        } else {
            $newpassword_db = $newpassword;
        }

        // Запись нового пароля в БД
        $qry = "UPDATE " . $this->user_table . " SET " . $this->pass_column . "='" . $newpassword_db . "' WHERE " . $this->user_column . "='" . stripslashes($username) . "'";
        $result = mysql_query($qry) or die(mysql_error());

        $to = stripslashes($username);
        // Антиинъекции
        $illegals = array("%0A", "%0D", "%0a", "%0d", "bcc:", "Content-Type", "BCC:", "Bcc:", "Cc:", "CC:", "TO:", "To:", "cc:", "to:");
        $to = str_replace($illegals, "", $to);
        $getemail = explode("@", $to);

        // В случае если логин это e-mail, происходит отправка письма
        if (sizeof($getemail) > 2) {
            return false;
        } else {
            // Компоновка письма
            $from = $_SERVER['SERVER_NAME'];
            $subject = "Password Reset: " . $_SERVER['SERVER_NAME'];
            $msg = "
 
Your new password is: " . $newpassword . "
 
";

            // Заголовки письма
            $headers = "MIME-Version: 1.0 rn";
            $headers .= "Content-Type: text/html; \r\n";
            $headers .= "From: $from  \r\n";

            // Отправка письма
            $sent = mail($to, $subject, $msg, $headers);
            if ($sent) {
                return true;
            } else {
                return false;
            }
        }
    }

    // Генерация пароля
    public function createPassword() {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime() * 1000000);
        $i = 0;
        $pass = '';
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }

    // Отрисовка формы логина
    public function loginform($formname, $formclass, $formaction) {
        $this->dbconnect();
        echo '
<form name="' . $formname . '" method="post" id="' . $formname . '" class="' . $formclass . '" enctype="application/x-www-form-urlencoded" action="' . $formaction . '">
<div><label for="username">Username</label>
<input name="username" id="username" type="text"></div>
<div><label for="password">Password</label>
<input name="password" id="password" type="password"></div>
<input name="action" id="action" value="login" type="hidden">
<div>
<input name="submit" id="submit" value="Login" type="submit"></div>
</form>
 
';
    }

    // Отрисовка формы смены пароля
    public function resetform($formname, $formclass, $formaction) {
        $this->dbconnect();
        echo '
<form name="' . $formname . '" method="post" id="' . $formname . '" class="' . $formclass . '" enctype="application/x-www-form-urlencoded" action="' . $formaction . '">
<div><label for="username">Username</label>
<input name="username" id="username" type="text"></div>
<input name="action" id="action" value="resetlogin" type="hidden">
<div>
<input name="submit" id="submit" value="Reset Password" type="submit"></div>
</form>
 
';
    }

    // Техническая функция создания таблицы для юзеров
    public function cratetable($tablename) {
        $this->dbconnect();
        $qry = "CREATE TABLE IF NOT EXISTS " . $tablename . " (
              userid int(11) NOT NULL auto_increment,
              useremail varchar(50) NOT NULL default '',
              password varchar(50) NOT NULL default '',
              PRIMARY KEY  (userid)
            )";
        $result = mysql_query($qry) or die(mysql_error());
        return;
    }
}
