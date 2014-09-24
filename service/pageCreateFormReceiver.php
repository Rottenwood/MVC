<?php
namespace PetrAurora;

require_once("../src/config/parameters.php");
require_once("../src/Core/Utils.php");
require_once("../src/Core/Route.php");
require_once("Checker.php");

use PetrAurora\Service\Checker;
use PetrAurora\Utils\Utils;

/**
 * Скрипт обработки формы создания страницы
 */
function createForm() {
    // Объект для работы с БД
    $mysqli = new \mysqli(Parameters::$hostname, Parameters::$username, Parameters::$password, Parameters::$database);

    // Полный путь до нового файла
    $uploadfile = Parameters::$uploadDir . basename($_FILES['avatar']['name']);

    // Перемещение из временной директории в основную
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)) {
        // Если файл загружен
        $pic = $_FILES['avatar']['name'];
    } else {
        // Если файл не загружен
        $pic = $_POST['pic'];
    }

    // Проверка названия
    if (!$_POST['title']) {
        $title = 'Статья от ' . date("m-d-y H:i:s");
    } else {
        $title = $_POST['title'];
    }

    // Проверка текста
    if ($_POST['context'] == '' || $_POST['context'] == '<br>') {
        $text = 'Отредактируйте эту страницу, добавив текст.';
    } else {
        $text = $_POST['context'];
    }

    // Транслитерация названия страницы
    $alias = Utils::translit($title);

    // Проверка алиаса на уникальность
    $checker = new Checker($mysqli);
    if (!$checker->checkUniqueAlias($alias)) {
        Route::redirect('aurora/error/2');
        return;
    }

    // Добавление записи в БД
    $stmt = $mysqli->prepare("INSERT INTO pages(title, content, alias, pic) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $title, $text, $alias, $pic);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    // Редирект на страницу со статьей
    Route::redirect('aurora/page/' . $alias);
}

createForm();
