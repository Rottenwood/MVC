<?php
namespace PetrAurora\View;

use PetrAurora\Controller;

/**
 * @author: Rottenwood
 * @date  Created: 22.09.14 19:02
 */

/**
 * Класс
 * @package PetrAurora\View
 */
class View {

    /**
     * Отрисовка вида из шаблона
     * @param string $contentView  название шаблона
     * @param null   $data         данные для передачи в вид
     * @param string $templateView родительский шаблон
     */
    function render($contentView, $data = null, $templateView = 'layout.html.php') {
        include 'src/View/' . $templateView;
    }
}