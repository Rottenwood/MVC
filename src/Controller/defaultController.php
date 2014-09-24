<?php
namespace PetrAurora\Controller;

/**
 * Главная страница
 * @package PetrAurora\Controller
 */
class defaultController extends Controller {

    public function indexAction() {
        $data = array();

        $data['url'] = $this->url;
        $data['title'] = 'Тестовое MVP приложение';
        $data['class']['main'] = 'active';

        $this->view->render('index.html.php', $data);
    }

}
