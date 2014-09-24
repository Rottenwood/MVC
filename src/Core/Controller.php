<?php
namespace PetrAurora\Controller;

use PetrAurora\loginService;
use PetrAurora\View;

class Controller {

    public $model;
    public $view;
    public $url;

    public function __construct() {
        $this->view = new View\View();
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $this->url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $url[1];
    }
}