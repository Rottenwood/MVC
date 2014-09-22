<?php
namespace PetrAurora;

use PetrAurora\Controller;
/**
 * Author: Rottenwood
 * Date Created: 22.09.14 18:46
 */

/**
 * Маршрутизатор
 */
class Route {

    static function init() {
        // Контроллер и метод по умолчанию
        $controllerName = 'default';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // Получение имени контроллера
        if (!empty($routes[2])) {
            $controllerName = $routes[2];
        }

        // Получение имени метода
        if (!empty($routes[3])) {
            $actionName = $routes[3];
        }

        // Указание имен для классов
        $modelName = $controllerName . 'Model';
        $controllerName = $controllerName . 'Controller';
        $actionName = $actionName . 'Action';

        // Загрузка файла с классом модели (файла модели может и не быть)
        $modelFile = $modelName . '.php';
        $modelPath = "src/Model/" . $modelFile;
        if (file_exists($modelPath)) {
            include "src/Model/" . $modelFile;
        }

        // Загрузка файла с классом контроллера
        $controllerFile = $controllerName . '.php';
        $controllerPath = "src/Controller/" . $controllerFile;
        if (file_exists($controllerPath)) {
            include "src/Controller/" . $controllerFile;
        } else {
            Route::ErrorPage404();
        }

        // Создание экземпляра контроллера
        $controllerNameSpace = '\\PetrAurora\\Controller\\' . $controllerName;
        $controller = new $controllerNameSpace;
        $action = $actionName;

        if (method_exists($controller, $action)) {
            // Вызов метода контроллера
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }

    }

    static function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
//        $requestUri = $_SERVER['REQUEST_URI'];

        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . 'aurora/error/pagenotfound');
    }

    /**
     * Статический метод для редиректа
     * @param $direction
     */
    static function redirect($direction) {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('Location:' . $host . $direction);
    }
}
