<?php
namespace PetrAurora\Controller;

class usersController extends Controller {

    public function indexAction() {
        $data['url'] = $this->url;
        $data['title'] = 'Пользователи';
        $data['class']['users'] = 'active';

        $this->view->generate('users.html.php', $data);
    }

}
