<?php
namespace PetrAurora\Model;

class editModel extends Model {

    public function getPageById($id) {
        $page = array();

        if ($stmt = $this->mysqli->prepare("SELECT p.title, p.content, p.alias, i.pic FROM pages p LEFT JOIN pics i ON p.pic_id = i.id WHERE p.id = ?")) {

            $stmt->bind_param('d', $id);
            $stmt->execute();
            $stmt->bind_result($title, $content, $alias, $pic);

            // Запись всех полученных имен пользователей в общий массив
            while ($stmt->fetch()) {
                $page['id'] = $id;
                $page['title'] = $title;
                $page['alias'] = $alias;
                $page['content'] = $content;
                $page['pic'] = 'data:image/jpeg;base64,' . base64_encode($pic);
            }

            $stmt->close();
        }

        $this->mysqli->close();

        return $page;
    }
}
