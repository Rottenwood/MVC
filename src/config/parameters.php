<?php
namespace PetrAurora;

/**
 * Параметры для доступа к БД
 * Author: Rottenwood
 * Date Created: 23.09.14 18:06
 */
class Parameters {

    // Реквизиты доступа к БД
    static public $hostname = 'localhost';
    static public $database = 'aurora';
    static public $username = 'petr';
    static public $password = 'inelep';

    // Поля в БД
    static public $userTable = 'users';
    static public $userColumn = 'useremail';
    static public $passwordColumn = 'password';
}