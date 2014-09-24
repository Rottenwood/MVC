<?php
namespace PetrAurora\Controller;

use PetrAurora\Model\usersModel;
use PetrAurora\View\View;

class usersController extends Controller {

    public function __construct() {
        $this->view = new View();
        $this->model = new usersModel();
        $this->url = explode('/', $_SERVER['REQUEST_URI']);
        $this->url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->url[1];
    }

    public function indexAction() {
        $data = array();

        $data['url'] = $this->url;
        $data['title'] = 'Пользователи';
        $data['class']['users'] = 'active';
        $data['users'] = $this->model->getAllUsers();

        $this->view->render('users.html.php', $data);
    }

}
