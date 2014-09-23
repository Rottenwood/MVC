<?php
namespace PetrAurora\Model;

/**
 * Author: Rottenwood
 * Date Created: 23.09.14 17:09
 */

class pageModel extends Model {

    public function getAllPages() {
        $result = array();

        $result[] = 'test';
        $result[] = 'test2';
        $result[] = 'test3';

        return $result;
    }
}
