<?php
namespace PetrAurora;

/**
 * Author: Rottenwood
 * Date Created: 23.09.14 1:30
 */

require_once("../../Core/Route.php");
include("../../Core/loginService.php");
$loginService = new loginService();

if ($_REQUEST['action'] == "login") {
    if ($loginService->login("users", $_REQUEST['username'], $_REQUEST['password']) == true) {
        // Введен верный пароль
    } else {
        // Пароль не верен
    }

    // Редирект на главную страницу
    Route::redirect('aurora');
}