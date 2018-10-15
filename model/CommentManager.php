<?php
namespace OCFram\Blog\Model;
require_once('model/Manager.php');

class CommentManager extends Manager {

    public function getComments($postId, $publish,$json='y') {
        $db = $this->dbConnect();
        if($publish == 'yes') {
            $q = $db->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, publish, avatar
                FROM bl_comments
                WHERE post_id = :id AND publish = 1
                ORDER BY comment_date");
        }
        if($publish == 'no') {
            $q = $db->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, publish, avatar
                FROM bl_comments 
                WHERE post_id = :id AND publish = 0
                ORDER BY comment_date");
        }
        if($publish == 'all') {
            $q = $db->prepare("SELECT id,author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, publish, avatar
                FROM bl_comments
                WHERE post_id = :id 
                ORDER BY publish ASC, comment_date DESC");
        }
        $q->bindValue(':id', $postId);
        $datas = $q->execute();
        if(count($datas) > 0) {
            $jsonCode = json_encode($q->fetchAll(\PDO::FETCH_ASSOC));
        }
        if($json == 'y') {
            $jsonFilename = 'tmp/getComments_' . UNIQID . '.json';
            if(file_exists($jsonFilename)) unlink($jsonFilename);
            if(count($datas) > 0) {
                $fp = fopen($jsonFilename, 'w+') ;
                fwrite($fp, $jsonCode);
                fclose($fp);
            }
        } else {
            return $jsonCode;
        }
    }

    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $q = $db->prepare("INSERT INTO bl_comments (post_id, author, comment, comment_date) VALUES (:postId, :author, :comment, NOW())");
        $q->bindValue(':postId', $postId);
        $q->bindValue(':author', $author);
        $q->bindValue(':comment', $comment);
        $affectedLines = $q->execute();
        return $affectedLines;
    }

    public function pubComment($postId, $comId, $val) {
        $db = $this->dbConnect();
        $q = $db->prepare("UPDATE bl_comments SET publish = :val
            WHERE id = :comId AND post_id = :postId");
        $q->bindValue(':comId', $comId);
        $q->bindValue(':postId', $postId);
        $q->bindValue(':val', $val);
        $affectedLines = $q->execute();
        return $affectedLines;
    }
}