<?php ob_start(); ?>
    <div class="container">
        <ol class="breadcrumb row">
            <li><a href="index.php?action=home">Accueil</a></li>
            <li><a href="index.php?action=listPosts">Articles</a></li>
            <li class="active">Suppression</li>
        </ol>

        <div class="panel panel-success">
            <div class="panel-heading row">
                <h6 class="text-center">    
                    <span class="col-md-8">TITRE</span>
                    <span class="col-md-3">CREATION</span>
                    <span class="col-md-1">&nbsp;</span>
                </h6>
            </div><!-- END (.panel-header ) -->
            <div class="panel-content">
                <ol class="list-group">
<?php
while($post = $posts->fetch()) {
?>
    <li class="list-group-item row">
        <small>
            <span class="col-md-8"><?= htmlspecialchars($post['title']) ?></span>
            <span class="col-md-3 text-center"><?= $post['creation_date_fr'] ?></span>
            <span class="col-md-1 text-center"><a href="index.php?action=delPostQry&id=<?= $post['id'] ?>"><span class="glyphicon glyphicon-trash"></span></a></span>
        </small>
    </li>
<?php
}
$posts->closeCursor();
?>
                </ol>
            </div><!-- END (.panel-content) -->
        </div><!-- END (.panel-default) --> 
    </div><!-- END (.container ) -->
<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>