<?php
namespace PetrAurora\Controller;

use PetrAurora\Route;

/**
 * Выход из системы
 * @package PetrAurora\Controller
 */
class logoutController extends Controller {

    public function indexAction() {
        session_destroy();
        Route::redirect('aurora');
    }

}
