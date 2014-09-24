<?php
namespace PetrAurora\Controller;

use PetrAurora\Route;
use PetrAurora\View;
use PetrAurora\Model;

/**
 * Страницы
 * @package PetrAurora\Controller
 */
class pageController extends Controller {

    public $model;
    public $url;

    public function __construct() {
        $this->view = new View\View();
        $this->model = new Model\pageModel();
        $this->url = explode('/', $_SERVER['REQUEST_URI']);
        $this->url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->url[1];
    }

    public function indexAction($page = null) {
        $data = array();

        $data['url'] = $this->url;
        $data['title'] = 'Страницы';
        $data['class']['page'] = 'active';

        if ($page) {
            // Если название страницы указано
            $pageArray = $this->model->getPageByAlias($page);

            if ($pageArray) {
                $data['title'] = $pageArray['title'];
                $data['id'] = $pageArray['id'];
                $data['pic'] = $pageArray['pic'];
                $data['content'] = $pageArray['content'];
                $this->view->render('singlePage.html.php', $data);
            } else {
                // Если страница не найдена
                Route::ErrorPage404();
            }
        } else {
            // Если страница не указана
            $data['pages'] = $this->model->getAllPages();
            $this->view->render('pages.html.php', $data);
        }
    }
}
