<?php
namespace PetrAurora\Model;

class pageModel extends Model {

    public function getAllPages() {
        $result = $this->mySqlService->getPages();

        return $result;
    }

    public function getPageByAlias($alias) {
        $result = $this->mySqlService->getPageByAlias($alias);

        return $result;
    }
}
