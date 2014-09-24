<?php
namespace PetrAurora\Controller;

class errorController extends Controller {

    public function indexAction() {
        $data = array();

        $data['url'] = $this->url;
        $data['title'] = 'Страница не найдена';
        $data['noMenu'] = 1;

        $this->view->render('404.html.php', $data);
    }
}
