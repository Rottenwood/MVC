<?php
namespace PetrAurora\Controller;

use PetrAurora\View;
use PetrAurora\Model;

/**
 * Удаление страниц
 * @package PetrAurora\Controller
 */
class deleteController extends Controller {

    public $model;
    public $url;

    public function __construct() {
        $this->view = new View\View();
        $this->model = new Model\deleteModel();
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $this->url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $url[1];
    }

    public function indexAction($id) {
        $data = array(
            'url'    => $this->url,
            'noMenu' => 1,
        );

        $this->model->deletePage($id);
        $data['message'] = "Страница с идентификатором $id была удалена.";

        $this->view->render('resultPage.html.php', $data);
    }

}
