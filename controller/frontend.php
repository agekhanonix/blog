<?php
    // Chargement des classes
    require_once('model/PostManager.php');
    require_once('model/CommentManager.php');
    require_once('model/MemberManager.php');
    require_once('model/VisitManager.php');
    /*require_once('libs/SplClassLoader.php');*/
    require_once('libs/OCFram/Cmail.php');
    //SplClassLoader::register();

    function addComment($postId, $avatar, $author, $comment) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        //$commentManager = new CommentManager();
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
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            require('view/frontend/addPost.php');
        } else {
            throw new Exception(json_encode(array('error' => "sec001",
                'msg' => "L'accès direct à un page d'administration est interdit",
                'type' => "affichage", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette page sans vous être authentifié")));
        }
    }
    
    function addMember($pseudo, $firstName, $lastName, $pwd, $email, $avatar) {
        $memberManager = new \OCFram\Blog\Model\MemberManager();
        //$memberManager = new MemberManager();
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
        //$commentManager = new CommentManager();
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
        $visitManager = new \OCFram\Blog\Model\VisitManager();
        //$memberManager = new MemberManager();
        //$visitManager = new VisitManager();
        $members = json_decode($memberManager->getMembers());
        $array = array();
        foreach($members as $member) {
            $array[$member->members_id]['id'] = $member->members_id;
            $array[$member->members_id]['pseudo'] = $member->members_pseudo;
            $array[$member->members_id]['lastName'] = $member->members_lastName;
            $array[$member->members_id]['firstName'] = $member->members_firstName;
            $array[$member->members_id]['registred'] = $member->members_registred;
            $array[$member->members_id]['creationDate'] = $member->creation_date_fr;
            $array[$member->members_id]['avatar'] = $member->members_avatar;
            $visits = json_decode($visitManager->getVisits($member->members_id));
            $ind=0;
            foreach($visits as $visit) {
                $array[$member->members_id]['visits'][$ind++]['date'] = $visit->visit_date_fr;   
            }
        }
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            require('view/frontend/delMembers.php');
        } else {
            throw new Exception(json_encode(array('error' => "sec001",
                'msg' => "L'accès direct à un page d'administration est interdit",
                'type' => "affichage", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette page sans vous être authentifié")));
        }
    }
    function delMember($id, $p) {
        $memberManager =  new \OCFram\Blog\Model\MemberManager();
        //$memberManager =  new MemberManager();
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            $affectedLines = $memberManager->delMember($id, $p);
        } else {
            throw new Exception(json_encode(array('error' => "sec002",
                'msg' => "L'accès direct à une requête d'administration est interdit",
                'type' => "request", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette requête sans vous être authentifié")));
        }
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
        //$postManager = new PostManager();
        //$commentManager = new CommentManager();
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
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            require('view/frontend/delPosts.php');
        } else {
            throw new Exception(json_encode(array('error' => "sec001",
                'msg' => "L'accès direct à un page d'administration est interdit",
                'type' => "affichage", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette page sans vous être authentifié")));
        }
    }

    function delPost($id) {
        $postManager =  new \OCFram\Blog\Model\PostManager();
        //$postManager =  new PostManager();
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            $affectedLines = $postManager->delPost($id);
        } else {
            throw new Exception(json_encode(array('error' => "sec002",
                'msg' => "L'accès direct à une requête d'administration est interdit",
                'type' => "request", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette requête sans vous être authentifié")));
        }
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
    function getPostsNo($publish, $js=true) {
        $postManager =  new \OCFram\Blog\Model\PostManager();
        //$postManager =  new PostManager();
        $nos = $postManager->getPostsNo($publish);
        if($js == true) {echo $nos;} else {return $nos;}
    }
    function getComments($postId, $publish, $js=true) {
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        //$commentManager = new CommentManager();
        $comments = $commentManager->getComments($postId, $publish);
        if($js == true) {echo $comments;} else {return $comments;}
    }
    function getError($error) {
        $err = json_decode($error);
        require('view/error.php');
    }
    function getMember($pseudo, $password) {
        $memberManager =  new \OCFram\Blog\Model\MemberManager();
        //$memberManager =  new MemberManager();
        $member = $memberManager->getMember($pseudo, $password);
        if($member !== null) {
            $_SESSION['level'] = $member['members_level'];
            $_SESSION['userId'] = $member['members_id'];
            $_SESSION['pseudo'] = $member['members_pseudo'];
            $_SESSION['lastName'] = $member['members_lastName'];
            $_SESSION['firstName'] = $member['members_firstName'];
            $_SESSION['email'] = $member['members_email'];
            $_SESSION['avatar'] = $member['members_avatar'];
            $visitManager = new \OCFram\Blog\Model\VisitManager();
            //$visitManager = new VisitManager();
            $affectedLines = $visitManager->addVisit($member['members_id'], getIp(), $member['members_pseudo']);
            if($affectedLines === false) {
                throw new Exception(json_encode(array('error' => "qry011",
                    'msg' => "La visite n'a pas été ajoutee",
                    'type' => "request", 
                    'name' => "addVisit", 
                    'script' => "controller/frontend.php", 
                    'explanation' => "erreur SQL")));
            } else {
                header('Location: index.php?action=home');
            }
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
        //$postManager =  new PostManager();
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            $affectedLines = $postManager->addPost($title, $content, $no);
        } else {
            throw new Exception(json_encode(array('error' => "sec002",
                'msg' => "L'accès direct à une requête d'administration est interdit",
                'type' => "request", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette requête sans vous être authentifié")));
        }
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
        //$postManager = new PostManager();
        //$commentManager = new CommentManager();
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
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            require('view/frontend/listComments.php');
        } else {
            throw new Exception(json_encode(array('error' => "sec001",
                'msg' => "L'accès direct à un page d'administration est interdit",
                'type' => "affichage", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette page sans vous être authentifié")));
        }
    }
    function listPosts($publish) {
        $postManager = new \OCFram\Blog\Model\PostManager();
        //$postManager = new PostManager();
        $posts = $postManager->getPosts($publish);
        require('view/frontend/listPosts.php');
    }
    function modPost($id) {
        $postManager = new \OCFram\Blog\Model\PostManager();
        //$postManager = new PostManager();
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            $post = $postManager->getPost($_GET['id']);
            require('view/frontend/modPost.php');
        } else {
            throw new Exception(json_encode(array('error' => "sec002",
                'msg' => "L'accès direct à une requête d'administration est interdit",
                'type' => "request", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette requête sans vous être authentifié")));
        }
    }
    function polities() {
        require('view/frontend/polities.php');
    }
    function post($publish) {
        $postManager = new \OCFram\Blog\Model\PostManager();
        $commentManager = new \OCFram\Blog\Model\CommentManager();
        //$postManager = new PostManager();
        //$commentManager = new CommentManager();
        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id'], $publish);
        require('view/frontend/post.php');
    }   
    function pubPost($id, $p) {
        $postManager =  new \OCFram\Blog\Model\PostManager();
        //$postManager =  new PostManager();
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            $affectedLines = $postManager->pubPost($id, $p);
        } else {
            throw new Exception(json_encode(array('error' => "sec002",
                'msg' => "L'accès direct à une requête d'administration est interdit",
                'type' => "request", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette requête sans vous être authentifié")));
        }
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
        //$commentManager = new CommentManager();
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            $affectedLines = $commentManager->updComment($postId, $commentId, $traitement);
        } else {
            throw new Exception(json_encode(array('error' => "sec002",
                'msg' => "L'accès direct à une requête d'administration est interdit",
                'type' => "request", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette requête sans vous être authentifié")));
        }
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
        //$postManager = new PostManager();
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            $affectedLines = $postManager->updPost($id, $num, $title, $content);
        } else {
            throw new Exception(json_encode(array('error' => "sec002",
                'msg' => "L'accès direct à une requête d'administration est interdit",
                'type' => "request", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette requête sans vous être authentifié")));
        }
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
        //$postManager = new PostManager();
        //$commentManager = new CommentManager();
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
        if(isset($_SESSION['pseudo']) && isset($_SESSION['level']) && $_SESSION['level'] == 4) {
            require('view/frontend/updPosts.php');
        } else {
            throw new Exception(json_encode(array('error' => "sec001",
                'msg' => "L'accès direct à un page d'administration est interdit",
                'type' => "affichage", 
                'name' => "", 
                'script' => "controller/frontend.php", 
                'explanation' => "Vous avez tenté d'acceder a cette page sans vous être authentifié")));
        }
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