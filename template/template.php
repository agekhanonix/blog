
<?php 
    /*= ----------------------------------------------------------------- ===
    === LOADING OF THE “HEADER”                                           ===
    === ----------------------------------------------------------------- =*/ 
    include 'view/header.html';
    /*= ----------------------------------------------------------------- ===
    === INITIALIZATION OF VARIOUS VARIABLES                               ===
    === ----------------------------------------------------------------- =*/
    $lvl = (isset($_SESSION['level'])) ? (int) $_SESSION['level'] : 0;
    $userId = (isset($_SESSION['userId'])) ? (int) $_SESSION['userId'] : 0;
    $pseudo = (isset($_SESSION['pseudo'])) ? $_SESSION['pseudo'] : '';
    $lastName = (isset($_SESSION['lastName'])) ? $_SESSION['lastName'] : 'MATE';
    $firstName = (isset($_SESSION['firstName'])) ? $_SESSION['firstName'] : 'Otto';
    $email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";
    $avatar = (isset($_SESSION['avatar'])) ? (int) $_SESSION['avatar'] : 1;
    $postId = (isset($_GET['id'])) ? (int) $_GET['id'] : '';
    /*= ----------------------------------------------------------------- ===
    === LOADING OF THE BAR OF NAVIGATION                                  ===
    === ----------------------------------------------------------------- =*/ 
    include 'view/nav.html';

    $search = array('{LEVEL1}');
    $replace = array('<i class="fas fa-pencil-alt" title="Ajouter un commentaire"></i><a href="index.php?action=addComment&amp;id=' . $postId . '" class="alert-link">&nbsp;un commentaire ...</a>');       
    $null = array('');
    $content = ($lvl >= 2) ? str_replace($search, $replace, $content ) : str_replace($search, $null, $content );

?>
    </header>
    <div class="row">
<!-- === ----------------------------------------------------------------- ===
     === IF IT IS NOT THE ADMINISTRATOR OF THE SITE ALL THE WIDTH IS USED  ===
     === ----------------------------------------------------------------- === --> 
<?php if(isset($_SESSION['userId']) && (int) $_SESSION['userId'] == 8) { ?>
        <section class="col-md-12 col-sm-12 col-xs-12">

<!-- === ----------------------------------------------------------------- ===
     === IF NOT ONE DISPLAYS ON TWO COLUMNS                                ===
     === ----------------------------------------------------------------- === --> 
<?php } else { ?>
        <section class="col-md-9 col-sm-12 col-xs-12">
<?php } ?>
            <?= $content ?>
        </section>
<?php if(!isset($_SESSION['userId'])) { ?>
<!-- === ----------------------------------------------------------------- ===
     === IF THE USER IS NOT CONNECTS                                       ===
     === ----------------------------------------------------------------- === -->
        <section class="col-md-3 col-sm-6 col-xs-12"><!-- Enregistrement -->
<?php
    include 'view/frontend/registering.php';
?>
        </section>
<?php } ?>
<!-- === ----------------------------------------------------------------- ===
     === IF IT IS NOT THE ADMINISTRATOR OF THE SITE                        ===
     === ----------------------------------------------------------------- === -->
<?php if(!isset($_SESSION['userId']) || (int) $_SESSION['userId'] !== 8) { ?>
        <section class="col-md-3 col-sm-6 col-xs-12"><!-- Contact -->
<?php
    include 'view/frontend/contact.php';
?>
        </section>
<?php } ?>
    </div><!-- END (row) -->
<?php
    /*= ----------------------------------------------------------------- ===
    === LOADING OF THE "FOOTER"                                           ===
    === ----------------------------------------------------------------- =*/ 
    include 'view/footer.html';