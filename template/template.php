<?php
    include 'view/header.html';
    $lvl = (isset($_SESSION['level'])) ? (int) $_SESSION['level'] : 0;
    $userId = (isset($_SESSION['userId'])) ? (int) $_SESSION['userId'] : 0;
    $pseudo = (isset($_SESSION['pseudo'])) ? $_SESSION['pseudo'] : '';
    $lastName = (isset($_SESSION['lastName'])) ? $_SESSION['lastName'] : 'MATE';
    $firstName = (isset($_SESSION['firstName'])) ? $_SESSION['firstName'] : 'Otto';
    $email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";
    $postId = (isset($_GET['id'])) ? (int) $_GET['id'] : '';
    include 'view/nav.html';
    $search = array('{LEVEL1}');
    $replace = array('<i class="fas fa-pencil-alt" title="Ajouter un commentaire"></i><a href="index.php?action=addComment&amp;id=' . $postId . '" class="alert-link">&nbsp;un commentaire ...</a>');       
    $null = array('');
    $content = ($lvl >= 2) ? str_replace($search, $replace, $content ) : str_replace($search, $null, $content );
?>
    <?= $content ?>
<?php
    include 'view/footer.html';