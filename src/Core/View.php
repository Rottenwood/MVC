<?php
namespace PetrAurora\View;

/**
 * Author: Rottenwood
 * Date Created: 22.09.14 19:02
 */
class View {

    function generate($contentView, $templateView = 'layout.html.php', $data = null) {

        include 'src/View/' . $templateView;
    }
}