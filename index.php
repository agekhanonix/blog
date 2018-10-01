<?php
    error_reporting(E_ALL); 
    ini_set("display_errors", 1); 
    session_start();
    require('config/config.php');
    require('controller/frontend.php');
   
    try {
        if(isset($_GET['action'])) {
            /* === ------------------------------------ === **
            **                   HOME MENU                  **
            ** === ------------------------------------ === */
            if($_GET['action'] == 'home') {
                home();

            /* === ------------------------------------ === **
            **                   BLOG MENU                  **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'listPosts') {
                if((!isset($_GET['publish'])) or (!in_array($_GET['publish'], array('all', 'yes', 'no')))) {
                    $publish = 'yes';
                } else {
                    $publish = $_GET['publish'];
                }
                listPosts($publish);
            } elseif($_GET['action'] == 'post') {
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    if((!isset($_GET['publish'])) or (!in_array($_GET['publish'], array('all', 'yes', 'no')))) {
                        $publish = 'yes';
                    } else {
                        $publish = $_GET['publish'];
                    } 
                    post($publish);
                } else {
                    throw new Exception("APL001");
                }
            
            /* === ------------------------------------ === **
            **                   ABOUT MENU                 **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'about') {
                about();
            
            /* === ------------------------------------ === **
            **                   CONTACT MENU               **
            ** === ------------------------------------ === */
            } elseif($_GET['action'] == 'contact') {
                contact();
            } elseif($_GET['action'] == 'mail') {
                if(!empty($_POST['name']) 
                    && !empty($_POST['email']) 
                    && !empty($_POST['sujet']) 
                    && !empty($_POST['message'])) {
                    mailSend($_POST['name'], $_POST['email'], $_POST['sujet'], $_POST['message']);
                } else {
                    throw new Exception('APL013');
                }
            /* === ------------------------------------ === **
            **                   POST MENU                  **
            ** === ------------------------------------ === **
            **                  POST ADDING                 */
            
            } elseif($_GET['action'] == 'addPost') {
                addPost();
            } elseif($_GET['action'] == 'addPostQry') {
                if(!empty($_POST['title']) && !empty($_POST['content'])) {
                    addPostQry($_POST['title'], $_POST['content']);
                } else {
                    throw new Exception('APL002');
                }
            
            /* ---                                      --- **
            /*                  POST UPDATING               */
            } elseif($_GET['action'] == 'updPost') {
            
            /*               POST PUBLISHING                */
            } elseif($_GET['action'] == 'pubPosts') {
                pubPosts();
            } elseif($_GET['action'] == 'pubPostQry') {
                if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['p']) && in_array($_GET['p'], array(0,1))) {
                    pubPostQry($_GET['id'], $_GET['p']);
                } else {
                    throw new Exception('APL003');
                }
            
            /* ---                                      --- **    
            /*                  POST DELETING               */
            } elseif($_GET['action'] == 'delPost') {
                delPosts();
            } elseif($_GET['action'] == 'delPostQry') {
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    delPostQry($_GET['id']);
                } else {
                    throw new Exception('APL004');
                }      
            
            /* === ------------------------------------ === **
            **                 MEMBERS MENU                 **
            ** === ------------------------------------ === */
            /*                  MEMBER SUPPRESS             */
            } elseif($_GET['action'] == 'delMember') {
                delMember();
            } elseif($_GET['action'] == 'delMemberQry') {
                if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['p']) && in_array($_GET['p'], array(0,1))) {
                    delMemberQry($_GET['id'], $_GET['p']);
                } else {
                    throw new Exception("APL005");
                }
            
            /* ===                                      === **
            **               ADDING COMMENT                 **
            ** ===                                      === */
            } elseif($_GET['action'] == 'addComment') {
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    addComment($_GET['id']);
                } else {
                    throw new Exception('APL006');
                }
              
            } elseif($_GET['action'] == 'addCommentQry') { 
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    if(!empty($_POST['comment'])) {
                        addCommentQry($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);
                    } else {
                        throw new Exception('APL007');
                    }
                } else {
                    throw new Exception('APL008');
                }
            } elseif($_GET['action'] == 'pubComments') {
                pubComments();
            } elseif($_GET['action'] == 'pubCommentQry') {
                if(isset($_GET['p']) && $_GET['p'] > 0 && isset($_GET['c']) && $_GET['c'] > 0 && isset($_GET['t']) && in_array($_GET['t'], array(0,1))) { 
                    pubCommentQry($_GET['p'], $_GET['c'], $_GET['t']);
                } else {
                    throw new Exception('APL012');
                }
            /* === ------------------------------------ === **
            **                 CONNEXION MENU               **
            ** === ------------------------------------ === */     
            } elseif($_GET['action'] == 'addMember') {
                addMember();
            } elseif($_GET['action'] == 'addMemberQry') {
                if(!empty($_POST['pseudo']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])
                    && !empty($_POST['pwd']) && !empty($_POST['confirm'])) {
                        if($_POST['pwd'] == $_POST['confirm']) {
                            addMemberQry($_POST['pseudo'], $_POST['firstname'], $_POST['lastname'], $_POST['pwd'],
                                $_POST['email'], $_POST['msn'], $_POST['avatar'], $_POST['url']);
                        } else {
                            throw new Exception('APL009'); 
                        }
                } else {
                        throw new Exception('APL010');
                }
            
            } elseif($_GET['action'] == 'connexion') {
                if(!empty($_POST['pseudo']) && !empty($_POST['pwd'])) {
                    getMember($_POST['pseudo'], $_POST['pwd']);
                } else {
                    throw new Exception('APL011');
                }
            } elseif($_GET['action'] == 'deconnexion') {
                deconnexion();
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