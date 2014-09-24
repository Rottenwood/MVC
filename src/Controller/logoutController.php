<?php
namespace PetrAurora\Controller;

use PetrAurora\Route;

class logoutController extends Controller {

    public function indexAction() {
        session_destroy();
        Route::redirect('aurora');
    }

}
