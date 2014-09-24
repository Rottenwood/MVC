<?php
namespace PetrAurora\Controller;

class loginController extends Controller {

    public function indexAction() {
        $data = array();

        $data['title'] = 'Вход в систему';
        $data['noMenu'] = 1;

        $this->view->render('login.html.php', $data);
    }

}
