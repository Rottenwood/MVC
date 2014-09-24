<?php
namespace PetrAurora;

session_start();

require_once("../../src/config/parameters.php");
require_once("../../src/Core/Route.php");
require_once("../../src/Core/MySqlService.php");

$mySqlService = new MySqlService();

if ($_REQUEST['action'] == "login") {
    if ($id = $mySqlService->checkUser($_REQUEST['username'], $_REQUEST['password'])) {

        // Генерация токена
        $token = md5($_REQUEST['password'] . 'superApp' . time());

        $mySqlService->setToken($id, $token);

        // Введен верный пароль, запись в сессию токена (не пароля)
        $_SESSION['token']['user'] = $_REQUEST['username'];
        $_SESSION['token']['token'] = $token;
    } else {
        // Пароль не верен
        echo 'Пароль не верен';
    }

    // Редирект на главную страницу
    Route::redirect('aurora');

}
