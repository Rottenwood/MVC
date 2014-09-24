<?php
namespace PetrAurora\Model;

/**
 * Модель для создания страниц
 * @package PetrAurora\Model
 */
class createModel extends Model {

    public function getPageById($id) {
        $page = array();

        if ($stmt = $this->mysqli->prepare("SELECT p.title, p.content, p.alias, p.pic FROM pages p WHERE p.id = ?")) {

            $stmt->bind_param('d', $id);
            $stmt->execute();
            $stmt->bind_result($title, $content, $alias, $pic);

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
