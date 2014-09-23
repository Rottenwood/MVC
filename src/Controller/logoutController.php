<?php
namespace PetrAurora\Controller;

use PetrAurora\Route;

class logoutController extends Controller {

    public function indexAction() {
        $this->loginService->logout();
        Route::redirect('aurora');
    }

}
