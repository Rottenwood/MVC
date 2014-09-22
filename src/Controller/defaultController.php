<?php
namespace PetrAurora\Controller;

class defaultController extends Controller {

    function indexAction() {
        $this->view->generate('index.html.php');
    }
}
