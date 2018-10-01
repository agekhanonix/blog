<?php
    // Chargement des classes
    require_once('model/PostManager.php');
    require_once('model/CommentManager.php');
    require_once('model/MemberManager.php');
    require_once('model/ErrorManager.php');
    require_once('libs/OCFram/Cmail.php');

    function listPosts($publish) {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $posts = $postManager->getPosts($publish);
        require('view/frontend/listPostsView.php');
    }

    function post($publish) {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $commentManager = new \OCFram\Blog\Model\CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id'], $publish);
        require('view/frontend/postView.php');
    }

    function addPost() {
        require('view/frontend/addPostView.php');
    }

    function addPostQry($title, $content) {
        $postManager =  new \OCFram\Blog\Model\PostManager();
        $affectedLines = $postManager->addPost($title, $content);
        if($affectedLines === false) {
            throw new Exception("QRY001");
        } else {
            header('Location: index.php?action=listPosts');
        }
    }

    function pubPosts() {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $posts = $postManager->getPosts('all');
        require('view/frontend/pubPostsView.php');
    }

    function pubPostQry($id, $p) {
        $postManager =  new \OCFram\Blog\Model\PostManager();
        $affectedLines = $postManager->pubPost($id, $p);
        if($affectedLines === false) {
            throw new Exception("QRY002");
        } else {
            header('Location: index.php?action=pubPosts');
        }
    }

    function delPosts() {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $posts = $postManager->getPosts('all');
        require('view/frontend/delPostsView.php');
    }

    function delPostQry($id) {
        $postManager =  new \OCFram\Blog\Model\PostManager();
        $affectedLines = $postManager->delPost($id);
        if($affectedLines === false) {
            throw new Exception("QRY003");
        } else {
            header('Location: index.php?action=delPost');
        }
    }


    function addComment($postId) {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $post = $postManager->getPost($_GET['id']);
        require('view/frontend/addCommentView.php');
    }

    function addCommentQry($postId, $author, $comment) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $affectedLines = $commentManager->postComment($postId, $author, $comment);
        if($affectedLines === false) {
            throw new Exception("QRY004");
        } else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
    function pubComments() {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $posts = $postManager->getPosts('all');
        $array = array();
        while($post = $posts->fetch()) {
            $array[$post['id']]['id'] = $post['id'];
            $array[$post['id']]['title'] = $post['title'];
            $array[$post['id']]['creation_date_fr'] = $post['creation_date_fr'];
            $array[$post['id']]['published'] = $post['published'];
            $comments = $commentManager->getComments($post['id'], 'all');
            $ind = 0;
            while($comment = $comments->fetch()) {
                $array[$post['id']]['details'][$ind]['id'] = $comment['id'];
                $array[$post['id']]['details'][$ind]['author'] = $comment['author'];
                $array[$post['id']]['details'][$ind]['comment'] = $comment['comment'];
                $array[$post['id']]['details'][$ind]['comment_date_fr'] = $comment['comment_date_fr'];
                $array[$post['id']]['details'][$ind]['publish'] = $comment['publish']; 
                $ind++;
            }
        }
        require('view/frontend/pubCommentView.php');
    }
    function pubCommentQry($postId, $commentId, $traitement) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $affectedLines = $commentManager->pubComment($postId, $commentId, $traitement);
        if($affectedLines === false) {
            throw new Eception("QRY008");
        } else {
            header('Location: index.php?action=pubComments');
        }
    }
    function addMember() {
        require('view/frontend/addMemberView.php');
    }
    
    function addMemberQry($pseudo, $firstName, $lastName, $pwd, $email, $msn, $avatar, $url) {
        $memberManager = new \OCFram\Blog\Model\MemberManager();
        $affectedLines = $memberManager->addMember($pseudo, $firstName, $lastName, $pwd, $email, $msn, $avatar, $url);
        if($affectedLines === false) {
            throw new Exception("QRY005");
        } else {
            header('Location: index.php?action=home');
        }
    }
    function delMember() {
        $memberManager = new \OCFram\Blog\Model\MemberManager();
        $members = $memberManager->getMembers();
        require('view/frontend/delMembersView.php');
    }
    function delMemberQry($id, $p) {
        $memberManager =  new \OCFram\Blog\Model\MemberManager();
        $affectedLines = $memberManager->delMember($id, $p);
        if($affectedLines === false) {
            throw new Exception("QRY006");
        } else {
            header('Location: index.php?action=delMember');
        }
    }

    function getMember($pseudo, $password) {
        $memberManager =  new \OCFram\Blog\Model\MemberManager();
        $member = $memberManager->getMember($pseudo, $password);
        if($member !== null) {
            $_SESSION['level'] = $member['members_level'];
            $_SESSION['userId'] = $member['members_id'];
            $_SESSION['pseudo'] = $member['members_pseudo'];
            $_SESSION['lastName'] = $member['members_lastName'];
            $_SESSION['firstName'] = $member['members_firstName'];
            header('Location: index.php?action=home');
        } else {
            throw new Exception("QRY007");
        }
    }
    function home() {
        require('view/home.php');
    }
    function deconnexion() {
        session_destroy();
        require('view/home.php');
    }
    function about() {
        require('view/home.php');
    }

    function contact() {
        require('view/contact.php');
    }

    function polities() {
        require('view/polities.php');
    }

    function getError($errorId) {
        $errorManager = new \OCFram\Blog\Model\ErrorManager();
        $error = $errorManager->getError($errorId);
        require('view/errorView.php');
    }
    function mailSend($name, $email, $sujet, $message) {
        $courriel = new Cmail();
        $courriel->fromName = $name;
        $courriel->from = $email;
        $courriel->to = "thierry.charpentier.ct@gmail.com";
        $courriel->cc = $email;
        $courriel->subject = $sujet;
        $courriel->message = $message;
        $courriel->charset = "iso-8859-2";
        $courriel->mime = "text/html";
        $courriel->send();
        require('view/home.php');
    }