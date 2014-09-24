<?php
namespace PetrAurora\Model;

class deleteModel extends Model {

    public function deletePage($id) {
        $result = $this->mySqlService->deletePage($id);

        return $result;
    }
}
