<?php
namespace PetrAurora\Controller;

/**
 * Каталог
 * @package PetrAurora\Controller
 */
class catalogController extends Controller {

    public function indexAction() {
        $data = array();

        $data['url'] = $this->url;
        $data['title'] = 'Каталог';
        $data['class']['catalog'] = 'active';

        $this->view->render('catalog.html.php', $data);
    }

}
