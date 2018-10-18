<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
    <div class="panel panel-danger">
        <div class="panel-heading">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span><?= $err->error ?>&nbsp;<?= $err->msg ?>
        </div>
        <div class="panel-content">
            <ol class="list-group">
                <li class="list-group-item">Dans un(e) : <?= $err->type ?> nommée : <?= $err->name ?></li>
                <li class="list-group-item">Script : <?= $err->script ?></li>
            </ol>
            <p><?= $err->explanation ?></p>
        </div>
        <div class="panel-footer">
            <div class="alert alert-info" role="alert">
                &nbsp;<span class="glyphicon glyphicon-circle-arrow-left" title="Retour vers le blog"  aria-hidden="true"></span>&nbsp;
                <a href="index.php?action=home" class="alert-link">Retour à l'accueil ...</a>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');