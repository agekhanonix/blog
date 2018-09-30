<?php ob_start(); ?>
    <div class="container">
        <ol class="breadcrumb row">
            <li><a href="index.php?action=home">Accueil</a></li>
            <li class="active">Blog</li>
        </ol>
        <header class="page-header">
            <h3>Les derniers articles</h3>
        </header>

<?php
while($post = $posts->fetch()) {
?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?= htmlspecialchars($post['title']) ?><br/>
                <small>soumis le <?= $post['creation_date_fr'] ?></small>
            </h3>
        </div>
        <div class="panel-content">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </div>
        <div class="panel-footer">
            <div class="alert alert-info" role="alert">
                &nbsp;<i class="far fa-eye" title="Voir les commentaires"></i>&nbsp;<a href="index.php?action=post&id=<?= $post['id'] ?>" class="alert-link">les commentaires ...</a>
            </div>
        </div>
    </div>
<?php
}
$posts->closeCursor();
?>
    </div><!-- END (.container )-->
<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>