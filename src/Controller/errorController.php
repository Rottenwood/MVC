<?php
namespace PetrAurora\Controller;

/**
 * Обработка страниц ошибок
 * @package PetrAurora\Controller
 */
class errorController extends Controller {

    public function indexAction($errorNum) {
        $data = array();

        if ($errorNum == 2) {
            $data['url'] = $this->url;
            $data['title'] = 'Выбранное название для статьи уже используется!';
            $data['message'] = 'К сожалению, выбранное название для статьи уже используется. Попробуйте выбрать
            другое.';
            $data['noMenu'] = 1;
        } else {
            $data['url'] = $this->url;
            $data['title'] = 'Страница не найдена';
            $data['message'] = 'К сожалению, запрошенная вами страница не была найдена.';
            $data['noMenu'] = 1;
        }

        $this->view->render('error.html.php', $data);
    }
}
