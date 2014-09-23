<?php
namespace PetrAurora\Controller;

use PetrAurora\View;
use PetrAurora\Model;

class pageController extends Controller {

    public $model;
    public $url;

    public function __construct() {
        $this->view = new View\View();
        $this->model = new Model\pageModel();
        $this->url = explode('/', $_SERVER['REQUEST_URI']);
        $this->url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->url[1];
    }

    public function indexAction() {
        $data['url'] = $this->url;
        $data['title'] = 'Страницы';
        $data['class']['page'] = 'active';

        $data['pages'] = $this->model->getAllPages();

        $this->view->generate('page.html.php', $data);
    }

}
