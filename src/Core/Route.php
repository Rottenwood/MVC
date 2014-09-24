<?php
namespace PetrAurora;

use PetrAurora\Controller;

/**
 * Маршрутизатор
 */
class Route {

    // Страницы, доступ на которые разрешен без авторизации
    public static $pagesBehindFirewall = array(
        '/aurora/login',
        '/aurora/error/pagenotfound',
    );

    /**
     * Маршрутизация приложения
     * @return bool
     */
    static function init() {
        // Контроллер и метод по умолчанию
        $controllerName = 'default';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // Получение имени контроллера
        if (!empty($routes[2])) {
            $controllerName = $routes[2];
        }

        // Получение имени страницы
        $page = $routes[3];

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

            // Фаерволл, доступ только после авторизации ко всем страницам,
            // кроме перечисленных в Route::$pagesBehindFirewall
            if (!in_array($_SERVER['REDIRECT_URL'], Route::$pagesBehindFirewall)) {
                // Сервис работы с БД
                $mySqlService = new MySqlService();

                if ($mySqlService->checkToken($_SESSION['token'])) {
                    include "src/Controller/" . $controllerFile;
                } else {
                    Route::redirect('aurora/login');
                }
            } else {
                include "src/Controller/" . $controllerFile;
            }

        } else {
            Route::ErrorPage404();
        }

        // Создание экземпляра контроллера
        $controllerNameSpace = '\\PetrAurora\\Controller\\' . $controllerName;
        $controller = new $controllerNameSpace;
        $action = $actionName;

        if (method_exists($controller, $action)) {
            // Вызов метода контроллера
            $controller->$action($page);
        } else {
            Route::ErrorPage404();
        }

        return true;
    }

    /**
     * Статический метод перенаправления на страницу 404
     * @return bool
     */
    static function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . 'aurora/error/pagenotfound');

        return true;
    }

    /**
     * Статический метод для редиректа
     * @param $direction
     * @return bool
     */
    static function redirect($direction) {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('Location:' . $host . $direction);

        return true;
    }
}
