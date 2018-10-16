<?php
namespace OCFram\Blog\Model;
require_once('model/Manager.php');

class CommentManager extends Manager {

    public function getComments($postId, $publish) {
        $db = $this->dbConnect();
        if($publish == 'yes') {
            $q = $db->prepare("SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, published, moderated, avatar
                FROM bl_comments
                WHERE post_id = :id AND published = 1
                ORDER BY comment_date");
        }
        if($publish == 'no') {
            $q = $db->prepare("SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, published, moderated, avatar
                FROM bl_comments 
                WHERE post_id = :id AND published = 0
                ORDER BY comment_date");
        }
        if($publish == 'all') {
            $q = $db->prepare("SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, published, moderated avatar
                FROM bl_comments
                WHERE post_id = :id 
                ORDER BY published ASC, comment_date DESC");
        }
        $q->bindValue(':id', $postId);
        $datas = $q->execute();
        if(count($datas) > 0) {
            $jsonCode = json_encode($q->fetchAll(\PDO::FETCH_ASSOC));
        }
        return $jsonCode;
    }

    public function addComment($postId, $avatar, $author, $comment) {
        $db = $this->dbConnect();
        $q = $db->prepare("INSERT INTO bl_comments (post_id, avatar, author, comment, comment_date) VALUES (:postId, :avatar, :author, :comment, NOW())");
        $q->bindValue(':postId', $postId);
        $q->bindValue(':author', $author);
        $q->bindValue(':comment', $comment);
        $q->bindValue(':avatar', $avatar);
        $affectedLines = $q->execute();
        return $affectedLines;
    }

    public function pubComment($postId, $comId, $val) {
        $db = $this->dbConnect();
        $q = $db->prepare("UPDATE bl_comments SET published = :val
            WHERE id = :comId AND post_id = :postId");
        $q->bindValue(':comId', $comId);
        $q->bindValue(':postId', $postId);
        $q->bindValue(':val', $val);
        $affectedLines = $q->execute();
        return $affectedLines;
    }
     public function askComment($postId, $comId, $val) {
         $db = $this->dbConnect();
         $q = $db->prepare("UPDATE bl_comments SET moderated = :val
            WHERE id = :comId AND post_id = :postId");
        $q->bindValue(':comId', $comId);
        $q->bindValue(':postId', $postId);
        $q->bindValue(':val', $val);
        $affectedLines = $q->execute();
        return $affectedLines; 
     }
}