<?php
namespace PetrAurora\Controller;

class errorController extends Controller {

    public function pagenotfoundAction() {
        $data['url'] = $this->url;
        $data['title'] = 'Страница не найдена';

        $this->view->generate('404.html.php', $data);
    }
}
