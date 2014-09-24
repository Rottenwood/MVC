<?php
namespace PetrAurora\Model;

/**
 * Получение данных о страницах
 * @package PetrAurora\Model
 */
class pageModel extends Model {

    /**
     * Запрос всех имеющихся страниц
     * @return array|bool
     */
    public function getAllPages() {
        $pages = array();

        if ($stmt = $this->mysqli->prepare("SELECT p.id, p.title, p.alias FROM pages p")) {

            $stmt->execute();
            $stmt->bind_result($id, $title, $alias);

            // Запись всех полученных имен пользователей в общий массив
            while ($stmt->fetch()) {
                $pages[$id]['title'] = $title;
                $pages[$id]['alias'] = $alias;
            }

            $stmt->close();
        }

        $this->mysqli->close();

        if (!is_null($pages)) {
            return $pages;
        } else {
            return false;
        }
    }

    /**
     * Получение страницы по алиасу
     * @param $alias
     * @return array
     */
    public function getPageByAlias($alias) {
        $page = array();

        if ($stmt = $this->mysqli->prepare("SELECT p.id, p.title, p.content, p.alias, p.pic FROM pages p WHERE p.alias = ?")) {

            $stmt->bind_param('s', $alias);
            $stmt->execute();
            $stmt->bind_result($id, $title, $content, $alias, $pic);

            // Запись всех полученных имен пользователей в общий массив
            while ($stmt->fetch()) {
                $page['id'] = $id;
                $page['title'] = $title;
                $page['alias'] = $alias;
                $page['content'] = $content;
                $page['pic'] = $pic;
            }

            $stmt->close();
        }

        $this->mysqli->close();

        return $page;
    }
}
