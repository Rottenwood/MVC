<?php
namespace PetrAurora\Controller;

class loginController extends Controller {

    function indexAction() {
        $data['title'] = 'Вход в систему';

        $this->view->generate('login.html.php', $data);
    }

}
