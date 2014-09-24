<?php
namespace PetrAurora\Service;

/**
 * Вспомогательный класс для проверки алиасов
 * @package PetrAurora\Service
 */
class Checker {

    public $mysqli;

    public function __construct(\mysqli $mysqli) {
        $this->mysqli = $mysqli;
    }

    /**
     * Проверка алиаса на уникальность
     * @param $alias
     * @return bool
     */
    public function checkUniqueAlias($alias) {
        $stmt = $this->mysqli->prepare("SELECT alias FROM pages WHERE alias = ?");
        $stmt->bind_param('s', $alias);
        $stmt->execute();
        $stmt->bind_result($aliasWasFound);

        while ($stmt->fetch()) {
            if ($aliasWasFound) {
                return false;
            }
        }

        $stmt->close();

        return true;
    }

    /**
     * Проверка алиаса на уникальность за исключением собственного id (для редактирования)
     * @param $id
     * @param $alias
     * @return bool
     */
    public function checkUniqueAliasWhenUpdate($id, $alias) {
        $stmt = $this->mysqli->prepare("SELECT alias FROM pages WHERE id != ? AND alias = ?");
        $stmt->bind_param('ss', $id, $alias);
        $stmt->execute();
        $stmt->bind_result($aliasWasFound);

        while ($stmt->fetch()) {
            if ($aliasWasFound) {
                return false;
            }
        }

        $stmt->close();

        return true;
    }
} 