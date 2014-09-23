<?php
namespace PetrAurora\Controller;

class defaultController extends Controller {

    public function indexAction() {
        $data['url'] = $this->url;
        $data['title'] = 'Тестовое MVP приложение';
        $data['class']['main'] = 'active';

        $this->view->generate('index.html.php', $data);
    }

}
