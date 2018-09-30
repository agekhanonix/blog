<?php
namespace OCFram\Blog\Model;
require_once('model/Manager.php');

class ErrorManager extends Manager {

    public function getError($errorId) {
        $db = $this->dbConnect();
        $q = $db->prepare("SELECT T1.id, T2.msg, T1.action, T1.name, T1.script, T1.path, T3.explanation 
            FROM bl_errors AS T1
                INNER JOIN bl_messages AS T2 ON T1.msg = T2.id
                INNER JOIN bl_explanations AS T3 ON T1.explanation = T3.id
            WHERE T1.id = :errorId");
        $q->bindValue(':errorId', $errorId);
        $q->execute();
        $data = $q->fetch();
        if(count($data) == 0) {
            return false;
        } else {
            return $data;
        }
    }
}