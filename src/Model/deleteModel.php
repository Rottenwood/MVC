<?php
namespace PetrAurora\Model;

/**
 * Удаление страниц
 * @package PetrAurora\Model
 */
class deleteModel extends Model {

    /**
     * Удалить страницу по идентификатору
     * @param $id
     * @return bool
     */
    public function deletePage($id) {
        $stmt = $this->mysqli->prepare("DELETE FROM pages WHERE id = ?");
        $stmt->bind_param('d', $id);
        $stmt->execute();
        $stmt->close();

        if ($stmt->affected_rows) {
            $return = (bool) true;
        } else {
            $return = (bool) false;
        }

        $this->mysqli->close();

        return $return;
    }
}
