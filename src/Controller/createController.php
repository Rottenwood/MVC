<?php
namespace PetrAurora\Controller;

use PetrAurora\View;
use PetrAurora\Model;

/**
 * Контроллер для создания страниц
 * @package PetrAurora\Controller
 */
class createController extends Controller {

    public $model;
    public $url;

    public function __construct() {
        $this->view = new View\View();
        $this->model = new Model\createModel();
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $this->url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $url[1];
    }

    public function indexAction() {
        $data = array(
            'url' => $this->url,
            'htmlHead' => '<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });</script>',
        );

        $this->view->render('create.html.php', $data);
    }
}
