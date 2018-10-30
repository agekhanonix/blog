<?php
namespace OCFram\Blog\Model;
require_once('model/Manager.php');
class VisitManager extends Manager {
    public function addVisit($memberId, $remoteAddr, $pseudo) {
        $db = $this->dbConnect();
        $q = $db->prepare("INSERT INTO bl_visits (member_id, remote_addr) 
            VALUES (:memberId, :remoteAddr)");
        $q->bindValue(':memberId', $memberId);
        $q->bindValue(':remoteAddr', $this->encrypt($remoteAddr,$pseudo));
        $affectedLines = $q->execute();
        return $affectedLines;
    }
    
    public function getVisits($memberId) {
        $db = $this->dbConnect();
        $q = $db->prepare("SELECT id, member_id, remote_addr, DATE_FORMAT(visit_date, '%d/%m/%Y à %Hh%imin%ss') AS visit_date_fr
            FROM bl_visits
            WHERE member_id = :memberId
            ORDER BY visit_date DESC");
        $q->bindValue(':memberId', $memberId);
        $datas = $q->execute();
        if(count($datas) > 0) {
            $jsonCode = json_encode($q->fetchAll(\PDO::FETCH_ASSOC));
        }
        return $jsonCode;
    }
    
    protected function encrypt($remoteAddr, $pseudo) {
        $encrypted_string = hash_hmac('sha512', $pseudo . $remoteAddr, '6Tune7+?2fred');
        return $encrypted_string;
    }
}