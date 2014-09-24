<?php
namespace PetrAurora;

session_start();

require_once("../../Core/Route.php");
require_once("../../Core/MySqlService.php");

$mySqlService = new MySqlService();
//$result = $mySqlService->checkUser('admin', 'inelep');

if ($_REQUEST['action'] == "login") {
    //    if ($loginService->login("users", $_REQUEST['username'], $_REQUEST['password']) == true) {
    //        // Введен верный пароль
    //    } else {
    //        // Пароль не верен
    //    }

    if ($token = $mySqlService->checkUser($_REQUEST['username'], $_REQUEST['password'])) {
        // Введен верный пароль, запись в сессию токена (не пароля)
        $_SESSION['token']['user'] = $_REQUEST['username'];
        $_SESSION['token']['token'] = $token;
    } else {
        echo 'forbidden';
        // Пароль не верен
    }

    // Редирект на главную страницу
    Route::redirect('aurora');

}
