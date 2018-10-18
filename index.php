<?php
    error_reporting(E_ALL); 
    ini_set("display_errors", 1); 
    session_start();
    require('config/config.php');
    require('controller/frontend.php');
    include('libs/OCFram/library.php');
   
    try {
        if(isset($_GET['action'])) {
            /* === ------------------------------------ === **
            **                   HOME PAGE                  **
            ** === ------------------------------------ === */
            if($_GET['action'] == 'home') {
                home();

            /* === ------------------------------------ === **
            **             MY LAST BOOK PAGE                **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'listPosts') {
                if((!isset($_GET['publish'])) or (!in_array($_GET['publish'], array('all', 'yes', 'no')))) {
                    $publish = 'yes';
                } else {
                    $publish = $_GET['publish'];
                }
                listPosts($publish);
            
            /* === ------------------------------------ === **
            **           CHAPTERS/CREATION PAGE             **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'addPost') {
                addPost();
            } elseif($_GET['action'] == 'insPost') {
                if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['no'])) {
                    insPost($_POST['title'], $_POST['content'], $_POST['no']);
                } else {
                    throw new Exception(json_encode(array('error' => "act001",
                        'msg' => "Toutes les infos nécéssaires n'ont pas été renseignées",
                        'type' => "action", 
                        'name' => "insPost", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }
            
            /* === ------------------------------------ === **
            **        CHAPTERS/MODIF./PUBLIC. PAGE          **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'updPosts') {
                updPosts();
            } elseif($_GET['action'] == 'pubPost') {
                if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['p']) && in_array($_GET['p'], array(0,1))) {
                    pubPost($_GET['id'], $_GET['p']);
                } else {
                    throw new Exception(json_encode(array('error' => "act002",
                        'msg' => "Toutes les infos nécéssaires n'ont pas été renseignées",
                        'type' => "action", 
                        'name' => "pubPost", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }
            } elseif($_GET['action'] == 'modPost') {
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    modPost($_GET['id']);
                } else {
                    throw new Exception(json_encode(array('error' => "act003",
                        'msg' => "Aucun identifiant de chapitre n'a été saisi",
                        'type' => "action", 
                        'name' => "modPost", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }
            } elseif($_GET['action'] == 'updPost') {
                if(isset($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['no']) && !empty($_POST['title']) && !empty($_POST['content'])) {
                    updPost($_GET['id'], $_POST['no'], $_POST['title'], $_POST['content']);
                } else {
                    throw new Exception(json_encode(array('error' => "act004",
                        'msg' => "Toutes les infos nécéssaires n'ont pas été renseignées",
                        'type' => "action", 
                        'name' => "updPost", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }
            /* === ------------------------------------ === **
            **         CHAPTERS/SUPPRESSION PAGE            **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'delPosts') {
                delPosts();
            } elseif($_GET['action'] == 'delPost') {
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    delPost($_GET['id']);
                } else {
                    throw new Exception(json_encode(array('error' => "act005",
                        'msg' => "Aucun identifiant de chapitre n'a été saisi",
                        'type' => "action", 
                        'name' => "delPost", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }
            
            /* === ------------------------------------ === **
            **         COMMENTS/MODERATION PAGE             **
            ** === ------------------------------------ === */   
            } elseif($_GET['action'] == 'listComments') {
                listComments();
            } elseif($_GET['action'] == 'updComment') {
                if(isset($_GET['p']) && $_GET['p'] > 0 && isset($_GET['c']) && $_GET['c'] > 0 && isset($_GET['t']) && in_array($_GET['t'], array(0,1))) { 
                    updComment($_GET['p'], $_GET['c'], $_GET['t']);
                } else {
                    throw new Exception(json_encode(array('error' => "act006",
                        'msg' => "Toutes les infos nécéssaires n'ont pas été renseignées",
                        'type' => "action", 
                        'name' => "updComment", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }
            
            /* === ------------------------------------ === **
            **          MEMBERS/REVOCATION PAGE             **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'delMembers') {
                delMembers();
            } elseif($_GET['action'] == 'delMember') {
                if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['p']) && in_array($_GET['p'], array(0,1))) {
                    delMember($_GET['id'], $_GET['p']);
                } else {
                    throw new Exception(json_encode(array('error' => "act007",
                        'msg' => "Toutes les infos nécéssaires n'ont pas été renseignées",
                        'type' => "action", 
                        'name' => "delMember", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }
            
            /* === ------------------------------------ === **
            **          ADDITION OF A COMMENT: ACTION       **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'addComment') { 
                if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['avatar'])) {
                    if(!empty($_POST['comment'.$_GET['id']])) {
                        addComment($_GET['id'],$_GET['avatar'], $_POST['pseudo'.$_GET['id']], $_POST['comment'.$_GET['id']]);
                    } else {
                        throw new Exception(json_encode(array('error' => "act008",
                            'msg' => "Toutes les infos nécéssaires n'ont pas été renseignées",
                            'type' => "action", 
                            'name' => "addComment", 
                            'script' => "index.php", 
                            'explanation' => "erreur dans le paramétrage du script")));
                    }
                } else {
                    throw new Exception(json_encode(array('error' => "act009",
                        'msg' => "Aucun identifiant de chapitre n'a été saisi",
                        'type' => "action", 
                        'name' => "addComment", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }

            /* === ------------------------------------ === **
            **          REQUEST FOR MODERATION: ACTION      **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'askComment') {
                if(isset($_GET['post']) && $_GET['post'] > 0 && isset($_GET['com']) & $_GET['com'] > 0 && $_GET['val'] == 1) {
                    askComment($_GET['post'], $_GET['com'], $_GET['val']);
                } else {
                    throw new Exception(json_encode(array('error' => "act010",
                        'msg' => "Toutes les infos nécéssaires n'ont pas été renseignées",
                        'type' => "action", 
                        'name' => "askComment", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }

             /* === ------------------------------------ === **
            **      COMMENTS RESEARCH FOR A CHAPTER: ACTION  **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'getComments') {
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    if((!isset($_GET['publish'])) or (!in_array($_GET['publish'], array('all', 'yes', 'no')))) {
                        $publish = 'yes';
                    } else {
                        $publish = $_GET['publish'];
                    } 
                }
                getComments($_GET['id'], $publish);

            /* === ------------------------------------ === **
            **            CHAPTER RESEARCH: ACTION          **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'post') {
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    if((!isset($_GET['publish'])) or (!in_array($_GET['publish'], array('all', 'yes', 'no')))) {
                        $publish = 'yes';
                    } else {
                        $publish = $_GET['publish'];
                    } 
                    post($publish);
                } else {
                    throw new Exception(json_encode(array('error' => "act010",
                        'msg' => "Aucun identifiant de chapitre n'a été renseigné",
                        'type' => "action", 
                        'name' => "post", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }
            
            /* === ------------------------------------ === **
            **             MAIL SENDING: ACTION             **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'mail') {
                if(!empty($_POST['name']) 
                    && !empty($_POST['email']) 
                    && !empty($_POST['sujet']) 
                    && !empty($_POST['message'])) {
                    mailSend($_POST['name'], $_POST['email'], $_POST['sujet'], $_POST['message'], $_POST['origin']);
                } else {
                    throw new Exception(json_encode(array('error' => "act011",
                        'msg' => "Toutes les infos nécéssaires n'ont pas été renseignées",
                        'type' => "action", 
                        'name' => "mail", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }
            
            /* === ------------------------------------ === **
            **         ADDITION OF A MEMBER: ACTION         **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'addMember') {
                if(!empty($_POST['pseudo']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])
                    && !empty($_POST['pwd']) && !empty($_POST['confirm'])) {
                        if($_POST['pwd'] == $_POST['confirm']) {
                            addMember($_POST['pseudo'], $_POST['firstname'], $_POST['lastname'], $_POST['pwd'],
                                $_POST['email'], $_POST['avatar']);
                        } else {
                            throw new Exception(json_encode(array('error' => "act012",
                                'msg' => "Le mot de passe et sa confirmation ne sont pas identiques",
                                'type' => "action", 
                                'name' => "addMember", 
                                'script' => "index.php", 
                                'explanation' => "erreur de saisie utilisateur")));
                        }
                } else {
                        throw new Exception(json_encode(array('error' => "act013",
                            'msg' => "Toutes les infos nécéssaires n'ont pas été renseignées",
                            'type' => "action", 
                            'name' => "addMember", 
                            'script' => "index.php", 
                            'explanation' => "erreur dans le paramétrage du script")));
                }
            
            /* === ------------------------------------ === **
            **                 LOGIN: ACTION                **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'connexion') {
                if(!empty($_POST['pseudo']) && !empty($_POST['pwd'])) {
                    getMember($_POST['pseudo'], $_POST['pwd']);
                } else {
                    throw new Exception(json_encode(array('error' => "act014",
                        'msg' => "Toutes les infos nécéssaires n'ont pas été renseignées",
                        'type' => "action", 
                        'name' => "connexion", 
                        'script' => "index.php", 
                        'explanation' => "erreur dans le paramétrage du script")));
                }

            /* === ------------------------------------ === **
            **                 LOGOUT: ACTION               **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'deconnexion') {
                deconnexion();

            /* === ------------------------------------ === **
            **          PRIVACY POLICY: POSTING             **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'shPolities') {
                polities();
            }
        } else {
            home();
        }
    } catch(Exception $e) {
        $errorMessage = $e->getMessage();
        getError($errorMessage);
    }