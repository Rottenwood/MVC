<?php
namespace PetrAurora\Controller;

class catalogController extends Controller {

    public function indexAction() {
        $data['url'] = $this->url;
        $data['title'] = 'Каталог';
        $data['class']['catalog'] = 'active';

        $this->view->generate('catalog.html.php', $data);
    }

}
