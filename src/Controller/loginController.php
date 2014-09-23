<?php
namespace PetrAurora\Controller;

class loginController extends Controller {

    public function indexAction() {
        $data['title'] = 'Вход в систему';

        $this->view->generate('login.html.php', $data);
    }

}
