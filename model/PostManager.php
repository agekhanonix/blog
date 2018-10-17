<?php
namespace OCFram\Blog\Model;
require_once('model/Manager.php');

class PostManager extends Manager {
    public function getPosts($publish) {
        $db = $this->dbConnect();
        // On récupère les 5 derniers billets
        if($publish == 'yes') {
            $q = $db->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr, 
             published FROM bl_posts WHERE published = 1 ORDER BY id ASC");
        }
        if($publish == 'no') {
            $q = $db->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr, 
            published FROM bl_posts WHERE published = 0 ORDER BY id ASC");
        }
        if($publish == 'all') {
            $q = $db->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr, 
            published FROM bl_posts ORDER BY id ASC");
        }
        return $q;
    }

    public function getPost($postId) {
        $db = $this->dbConnect();
        // Récupération du billet
        $q = $db->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr 
            FROM bl_posts 
            WHERE id = :id");
        $q->bindValue(':id', $postId);
        $q->execute();
        $data = $q->fetch();
        return $data;
    }

    public function addPost($title, $content) {
        $db = $this->dbConnect();
        $q = $db->prepare("INSERT INTO bl_posts (title, content, creation_date) VALUES (:title, :content, NOW())");
        $q->bindValue(':title', $title);
        $q->bindValue(':content', $content);
        $q->execute();
        return $q;
    }

    public function pubPost($postId, $publish) {
        $db = $this->dbConnect();
        $q = $db->prepare("UPDATE bl_posts SET published = :p WHERE id = :id");
        $q->bindValue(':id', $postId);
        $q->bindValue(':p', $publish);
        $q->execute();
        return $q;
    }

    public function delPost($postId) {
        $db = $this->dbConnect();
        $q = $db->prepare("DELETE FROM bl_posts WHERE id = :id");
        $q->bindValue(':id', $postId);
        $q->execute();
        return $q;
    }
}