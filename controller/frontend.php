<?php
    // Chargement des classes
    require_once('model/PostManager.php');
    require_once('model/CommentManager.php');
    require_once('model/MemberManager.php');
    require_once('model/ErrorManager.php');
    require_once('libs/OCFram/Cmail.php');

    function addComment($postId, $avatar, $author, $comment) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $affectedLines = $commentManager->addComment($postId, $avatar, $author, strip_tags($comment));
        if($affectedLines === false) {
            throw new Exception(json_encode(array('error' => "qry001",
                'msg' => "Le commentaire n'a pas été ajouté",
                'type' => "request", 
                'name' => "addComment", 
                'script' => "controller/frontend.php", 
                'explanation' => "erreur SQL")));
        } else {
            header('Location: index.php?action=listPosts');
        }
    }
    function addPost() {
        require('view/frontend/addPost.php');
    }
    
    function addMember($pseudo, $firstName, $lastName, $pwd, $email, $avatar) {
        $memberManager = new \OCFram\Blog\Model\MemberManager();
        $affectedLines = $memberManager->addMember($pseudo, $firstName, $lastName, $pwd, $email, $avatar);
        if($affectedLines === false) {
            throw new Exception(json_encode(array('error' => "qry002",
                'msg' => "Le membre n'a pas été ajouté",
                'type' => "request", 
                'name' => "addMember", 
                'script' => "controller/frontend.php", 
                'explanation' => "erreur SQL")));
        } else {
            header('Location: index.php?action=home');
        }
    }
    function askComment($postId, $comId, $val) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $affectedLines = $commentManager->askComment($postId, $comId, $val);
        if($affectedLines === false) {
            throw new Exception(json_encode(array('error' => "qry003",
                'msg' => "La demande de modération n'a pas été faite",
                'type' => "request", 
                'name' => "askComment", 
                'script' => "controller/frontend.php", 
                'explanation' => "erreur SQL")));
        } else {
            header('Location: index.php?action=listPosts');
        }
    }
    function contact() {
        require('view/frontend/contact.php');
    }
    function deconnexion() {
        session_destroy();
        require('view/frontend/home.php');
    }
    function delMembers() {
        $memberManager = new \OCFram\Blog\Model\MemberManager();
        $members = $memberManager->getMembers();
        require('view/frontend/delMembers.php');
    }
    function delMember($id, $p) {
        $memberManager =  new \OCFram\Blog\Model\MemberManager();
        $affectedLines = $memberManager->delMember($id, $p);
        if($affectedLines === false) {
            throw new Exception(json_encode(array('error' => "qry004",
                'msg' => "Le membre n'a pas été supprimé",
                'type' => "request", 
                'name' => "delMember", 
                'script' => "controller/frontend.php", 
                'explanation' => "erreur SQL || inexistance du membre")));
        } else {
            header('Location: index.php?action=delMembers');
        }
    }
    function delPosts() {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $posts = $postManager->getPosts('all');
        $array = array();
        while($post = $posts->fetch()) {
            $array[$post['id']]['id'] = $post['id'];
            $array[$post['id']]['no'] = $post['no'];
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
        require('view/frontend/delPosts.php');
    }

    function delPost($id) {
        $postManager =  new \OCFram\Blog\Model\PostManager();
        $affectedLines = $postManager->delPost($id);
        if($affectedLines === false) {
            throw new Exception(json_encode(array('error' => "qry005",
                'msg' => "Le chapitre n'a pas été supprimé",
                'type' => "request", 
                'name' => "delPost", 
                'script' => "controller/frontend.php", 
                'explanation' => "erreur SQL || inexistance du chapitre")));
        } else {
            header('Location: index.php?action=delPosts');
        }
    }
    function getComments($postId, $publish, $js=true) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $comments = $commentManager->getComments($postId, $publish);
        if($js == true) {echo $comments;} else {return $comments;}
    }
    function getError($error) {
        $err = json_decode($error);
        require('view/error.php');
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
            throw new Exception(json_encode(array('error' => "qry006",
                'msg' => "Le membre n'a pas été trouvé",
                'type' => "request", 
                'name' => "getMember", 
                'script' => "controller/frontend.php", 
                'explanation' => "erreur SQL || inexistance du membre")));
        }
    }
    function home() {
        require('view/frontend/home.php');
    }
    function insPost($title, $content, $no) {
        $postManager =  new \OCFram\Blog\Model\PostManager();
        $affectedLines = $postManager->addPost($title, $content, $no);
        if($affectedLines === false) {
            throw new Exception(json_encode(array('error' => "qry007",
                'msg' => "Le chapitre n'a pas été ajouté",
                'type' => "request", 
                'name' => "insPost", 
                'script' => "controller/frontend.php", 
                'explanation' => "erreur SQL || inexistance du membre")));
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
            $array[$post['id']]['no'] = $post['no'];
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
    function listPosts($publish) {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $posts = $postManager->getPosts($publish);
        require('view/frontend/listPosts.php');
    }
    function modPost($id) {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $post = $postManager->getPost($_GET['id']);
        require('view/frontend/modPost.php');
    }
    function polities() {
        require('view/frontend/polities.php');
    }
    function post($publish) {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $commentManager = new \OCFram\Blog\Model\CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id'], $publish);
        require('view/frontend/post.php');
    }   
    function pubPost($id, $p) {
        $postManager =  new \OCFram\Blog\Model\PostManager();
        $affectedLines = $postManager->pubPost($id, $p);
        if($affectedLines === false) {
            throw new Exception(json_encode(array('error' => "qry008",
                'msg' => "Le chapitre n'a pas été publié",
                'type' => "request", 
                'name' => "pubPost", 
                'script' => "controller/frontend.php", 
                'explanation' => "erreur SQL || inexistance du chapitre")));
        } else {
            header('Location: index.php?action=updPosts');
        }
    }
    function updComment($postId, $commentId, $traitement) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $affectedLines = $commentManager->updComment($postId, $commentId, $traitement);
        if($affectedLines === false) {
            throw new Exception(json_encode(array('error' => "qry009",
                'msg' => "Le commentaire n'a pas été modéré/ou l'inverse",
                'type' => "request", 
                'name' => "updComment", 
                'script' => "controller/frontend.php", 
                'explanation' => "erreur SQL || inexistance du commentaire")));
        } else {
            header('Location: index.php?action=listComments');
        }
    }
    function updPost($id, $num, $title, $content) {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $affectedLines = $postManager->updPost($id, $num, $title, $content);
        if($affectedLines === false) {
            throw new Exception(json_encode(array('error' => "qry010",
                'msg' => "Le chapitre n'a pas été modifié",
                'type' => "request", 
                'name' => "updPost", 
                'script' => "controller/frontend.php", 
                'explanation' => "erreur SQL || inexistance du chapitre")));
        } else {
            header('Location: index.php?action=updPosts');
        }
    }
    function updPosts() {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        $posts = $postManager->getPosts('all');
        $array = array();
        while($post = $posts->fetch()) {
            $array[$post['id']]['id'] = $post['id'];
            $array[$post['id']]['no'] = $post['no'];
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
        require('view/frontend/updPosts.php');
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