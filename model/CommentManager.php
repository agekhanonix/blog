<?php
namespace OCFram\Blog\Model;
require_once('model/Manager.php');

class CommentManager extends Manager {

    public function getComments($postId, $publish) {
        $db = $this->dbConnect();
        if($publish == 'yes') {
            $q = $db->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, publish
                FROM agekhanokcroot.bl_comments
                WHERE post_id = :id AND publish = 1
                ORDER BY comment_date");
        }
        if($publish == 'no') {
            $q = $db->prepare("SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, publish
                FROM agekhanokcroot.bl_comments
                WHERE post_id = :id AND publish = 0
                ORDER BY comment_date");
        }
        if($publish == 'all') {
            $q = $db->prepare("SELECT id,author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr, publish
                FROM agekhanokcroot.bl_comments
                WHERE post_id = :id 
                ORDER BY comment_date");
        }
        $q->bindValue(':id', $postId);
        $q->execute();
        return $q;
    }

    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $q = $db->prepare("INSERT INTO agekhanokcroot.bl_comments (post_id, author, comment, comment_date) VALUES (:postId, :author, :comment, NOW())");
        $q->bindValue(':postId', $postId);
        $q->bindValue(':author', $author);
        $q->bindValue(':comment', $comment);
        $affectedLines = $q->execute();
        return $affectedLines;
    }

    public function pubComment($postId, $comId, $val) {
        $db = $this->dbConnect();
        $q = $db->prepare("UPDATE agekhanokcroot.bl_comments SET publish = :val
            WHERE id = :comId AND post_id = :postId");
        $q->bindValue(':comId', $comId);
        $q->bindValue(':postId', $postId);
        $q->bindValue(':val', $val);
        $affectedLines = $q->execute();
        return $affectedLines;
    }
}