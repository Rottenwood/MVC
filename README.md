MVC
===

MVC test cms

Работающая версия приложения: http://utopia.ml/aurora

(логин/пароль: test/test)

Данное приложение было создано с использованием подхода MVP, разделяющего логику от представления. Человекопонятные ссылки реализованы методом Front Controller, при котором веб-сервер (апач с помощью .htaccess) настроен на единственную точку входа в приложение (index.php), которая в свою очередь использует класс Маршрутизатора (src/Core/Route.php) для загрузки нужных контроллеров, соответсвующих запрашиваемым страницам.

Используется фаерволл, запрещающий доступ без логина ко всем страницам, кроме указанных в конфигурации Route::$pagesBehindFirewall, а именно страницы 404, и непосредственно страницы с формой логина.

Структура БД состоит из двух таблиц:

users, в которой содержатся реквизиты достыпа пользователей
pages, содержащей в себе информацию о дополнительных страницах
Изображения загружаются в "upload/"

В качестве wysiwyg редактора используется JS-редактор nicedit.

Файлы
=====
Дамп БД: https://github.com/Rottenwood/MVC/blob/master/aurora.sql

Маршрутизатор: https://github.com/Rottenwood/MVC/blob/master/src/Core/Route.php

Контроллеры: https://github.com/Rottenwood/MVC/tree/master/src/Controller

Модель: https://github.com/Rottenwood/MVC/tree/master/src/Model

Вид (шаблоны): https://github.com/Rottenwood/MVC/tree/master/src/View
