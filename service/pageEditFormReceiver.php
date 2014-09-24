<?php
namespace PetrAurora;

require_once("../src/config/parameters.php");
require_once("../src/Core/Utils.php");
require_once("../src/Core/Route.php");
require_once("Checker.php");

use PetrAurora\Service\Checker;
use PetrAurora\Utils\Utils;

/**
 * Скрипт обработки формы редактирования страницы
 */
function editForm() {
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

    // Транслитерация названия страницы
    $alias = Utils::translit($_POST['title']);

    // Проверка текста
    if (!$_POST['context']) {
        $text = 'Отредактируйте эту страницу, добавив текст.';
    } else {
        $text = $_POST['context'];
    }

    // Проверка алиаса на уникальность
    $checker = new Checker($mysqli);
    if (!$checker->checkUniqueAliasWhenUpdate($_POST['id'], $alias)) {
        Route::redirect('aurora/error/2');
        return;
    }

    // Обновление записи в БД
    $stmt = $mysqli->prepare("UPDATE pages SET title = ?, content = ?, alias = ?, pic = ? WHERE id = ?");
    $stmt->bind_param('ssssd', $_POST['title'], $text, $alias, $pic, $_POST['id']);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    // Редирект на страницу со статьей
    Route::redirect('aurora/page/' . $alias);
}

editForm();
