<?php
namespace PetrAurora\Controller;

class defaultController extends Controller {

    function indexAction() {
        $data['title'] = 'Тестовое MVP приложение';

        $this->view->generate('index.html.php', $data);
    }

}
