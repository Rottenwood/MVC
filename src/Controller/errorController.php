<?php
namespace PetrAurora\Controller;

class errorController extends Controller {

    function pagenotfoundAction() {
        $data['title'] = 'Страница не найдена';
        $data['url'] = $this->url;

        $this->view->generate('404.html.php', $data);
    }
}
