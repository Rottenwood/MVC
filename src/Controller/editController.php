<?php
namespace PetrAurora\Controller;

use PetrAurora\Route;
use PetrAurora\View;
use PetrAurora\Model;

class editController extends Controller {

    public $model;
    public $url;

    public function __construct() {
        $this->view = new View\View();
        $this->model = new Model\editModel();
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $this->url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $url[1];
    }

    public function indexAction($id) {
        $data = array(
            'url' => $this->url,
            'htmlHead' => '<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });</script>'
        );

        $result = $this->model->getPageById($id);


        if ($result) {
            $data = array_merge($data, $result);
            $data['title'] = 'Редактирование страницы';
        } else {
            Route::ErrorPage404();
        }

        $this->view->render('edit.html.php', $data);
    }

}
