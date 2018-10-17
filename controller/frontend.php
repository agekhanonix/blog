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
    function getComments($postId, $publish, $js=true) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $comments = $commentManager->getComments($postId, $publish);
        if($js == true) {echo $comments;} else {return $comments;}
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


    function addComment($postId, $avatar, $author, $comment) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $affectedLines = $commentManager->addComment($postId, $avatar, $author, strip_tags($comment));
        if($affectedLines === false) {
            throw new Exception("QRY004");
        } else {
            header('Location: index.php?action=listPosts');
        }
    }

    function askComment($postId, $comId, $val) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $affectedLines = $commentManager->askComment($postId, $comId, $val);
        if($affectedLines === false) {
            throw new Exception("QRY013");
        } else {
            header('Location: index.php?action=listPosts');
        }
    }
    function listComments() {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $posts = $postManager->getPosts('all');
        $array = array();
        while($post = $posts->fetch()) {
            $array[$post['id']]['id'] = $post['id'];
            $array[$post['id']]['title'] = $post['title'];
            $array[$post['id']]['creation_date_fr'] = $post['creation_date_fr'];
            $array[$post['id']]['published'] = $post['published'];
            $comments = json_decode($commentManager->getComments($post['id'], 'mod'));
            for($i=0; $i<count($comments); $i++) {
                $array[$post['id']]['details'][$i]['id'] = $comments[$i]->id;
                $array[$post['id']]['details'][$i]['post_id'] = $comments[$i]->post_id;
                $array[$post['id']]['details'][$i]['author'] = $comments[$i]->author;
                $array[$post['id']]['details'][$i]['comment'] = $comments[$i]->comment;
                $array[$post['id']]['details'][$i]['comment_date_fr'] = $comments[$i]->comment_date_fr;
                $array[$post['id']]['details'][$i]['published'] = $comments[$i]->published;
                $array[$post['id']]['details'][$i]['moderated'] = $comments[$i]->moderated;
                $array[$post['id']]['details'][$i]['avatar'] = $comments[$i]->avatar;
            }
        }
        require('view/frontend/listComments.php');
    }

    function updComment($postId, $commentId, $traitement) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $affectedLines = $commentManager->updComment($postId, $commentId, $traitement);
        if($affectedLines === false) {
            throw new Eception("QRY008");
        } else {
            header('Location: index.php?action=listComments');
        }
    }
    function addMember($pseudo, $firstName, $lastName, $pwd, $email, $avatar) {
        $memberManager = new \OCFram\Blog\Model\MemberManager();
        $affectedLines = $memberManager->addMember($pseudo, $firstName, $lastName, $pwd, $email, $avatar);
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
            $_SESSION['email'] = $member['members_email'];
            $_SESSION['avatar'] = $member['members_avatar'];
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
    function mailSend($name, $email, $sujet, $message, $origine) {
        $patterns = array('{NOM}', '{MESSAGE}', '{SUBJECT}','{EMAIL}', '{ORIGINE}');
        if(is_null($origine) || $origine == 5) {
            $origine = 'un autre moyen.';
        } elseif($origine == 1) {
            $origine = 'un ami.';
        } elseif($origine == 2) {
            $origine = 'la radio.';
        } elseif($origine == 3) {
            $origine = 'la télévision.';
        } elseif($origine == 4) {
            $origine = 'le web.';
        }
        $replaces = array($name, $message, $sujet, $email, $origine);
        $mail = str_replace($patterns, $replaces,file_get_contents("divers/corps.html"));

        $from = "agekhanokc@cluster026.hosting.ovh.net";
        $fromName = "Webmaster";
        $cc = $email;
        $to = "thierry.charpentier.ct@gmail.com";
        $bcc =  $email;
        $subject = $name . " VOUS A ENVOYE UN COURRIEL A " . date("H:i:s");
    
        $courriel = new Cmail();
        $courriel->to = $to;
        $courriel->cc = $cc;
        $courriel->bcc = $bcc;
        $courriel->from = $from;
        $courriel->fromName = $fromName;
        $courriel->subject = $subject;
        $courriel->message = $mail;
        $courriel->send();
        header('Location: index.php?action=home');
    }