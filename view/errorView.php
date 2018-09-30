<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<div class="container">
    <div class="panel panel-danger">
        <div class="panel-heading">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span><?= $error['id'] ?>&nbsp;<?= $error['msg'] ?>
        </div>
        <div class="panel-content">
            <ol class="list-group">
                <li class="list-group-item">Dans une : <?= $error['action'] ?> nommée : <?= $error['name'] ?></li>
                <li class="list-group-item">Script : <?= $error['script'] ?></li>
                <li class="list-group-item">Chemin : <?= $error['path'] ?></li>
            </ol>
            <p><?= $error['explanation'] ?></p>
        </div>
        <div class="panel-footer">
            <div class="alert alert-info" role="alert">
                &nbsp;<span class="glyphicon glyphicon-circle-arrow-left" title="Retour vers le blog"  aria-hidden="true"></span>&nbsp;
                <a href="index.php?action=listPosts" class="alert-link">Retour vers le blog ...</a>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');