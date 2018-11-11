<?php
namespace OCFram\Blog\Model;
require_once('model/Manager.php');
class MemberManager extends Manager {
    public function addMember($pseudo, $firstName, $lastName, $pwd, $email, $avatar) {
        $db = $this->dbConnect();
        $q = $db->prepare("INSERT INTO bl_members (members_pseudo, members_firstName, members_lastName, members_pwd, members_email, members_avatar, members_creationDate) 
            VALUES (:pseudo, :firstName, :lastName, :pwd, :email, :avatar, NOW())");
        $q->bindValue(':pseudo', $pseudo);
        $q->bindValue(':lastName', $lastName);
        $q->bindValue(':firstName', $firstName);
        $q->bindValue(':pwd', $this->encrypt($pwd, $pseudo));
        $q->bindValue(':email', $email);
        $q->bindValue(':avatar', $avatar);
        $affectedLines = $q->execute();
        return $affectedLines;
    }
    public function getMember($pseudo, $pwd) {
        $db = $this->dbConnect();
        $q = $db->prepare("SELECT members_id, members_pseudo, members_pwd, members_lastName, members_firstName, members_level, members_email, members_avatar FROM bl_members WHERE members_pseudo = :pseudo AND members_pwd = :pwd AND members_registred = 0  LIMIT 0,1");
        $q->bindValue(':pseudo', $pseudo);
        $q->bindValue(':pwd',$this->encrypt($pwd, $pseudo));
        $q->execute();
        $data = $q->fetch();
        if(count($data) == 0) {
            return false;
        } else {
            return $data;
        }
    }
    public function delMember($id, $register) {
        $db = $this->dbConnect();
        $q = $db->prepare("UPDATE bl_members SET members_registred = :p WHERE members_id = :id");
        $q->bindValue(':id', $id);
        $q->bindValue(':p', $register);
        $q->execute();
        return $q;
    }
    public function getMembers() {
        $db = $this->dbConnect();
        $q = $db->query("SELECT members_id, members_pseudo, members_lastName, members_firstName, members_level, DATE_FORMAT(members_creationDate, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr,members_registred, members_avatar 
            FROM bl_members
            ORDER BY members_pseudo ASC");
        $jsonCode = json_encode($q->fetchAll(\PDO::FETCH_ASSOC));
        return $jsonCode;
    }
    protected function encrypt($pwd, $pseudo) {
        $encrypted_string = hash_hmac('sha512', $pseudo . $pwd, '6Tune7+?2fred');
        return $encrypted_string;
    }
}