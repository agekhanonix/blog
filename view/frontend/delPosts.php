<?php ob_start(); ?>
    <ol class="breadcrumb row">
        <li><a href="index.php?action=home">Accueil</a></li>
        <li><a href="#">Chapitres</a></li>
        <li class="active">Suppression</li>
    </ol>
    <div class="content">
        <header class="page-header">
            <h4>Suppression d'un chapitre</h4>
        </header>
        <section class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title row">
                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">Les chapitres du livre</div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><small>Publification</small></div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><small>Suppression</small></div>
                        <div class="col-offset-lg-2 col-offset-md-2 col-offset-sm-2 col-offset-xs-2"></div>
                    </h3>
                </div>
            <div class="list-group">
<?php foreach($array as $row) { ?>
    <div class="list-group-item">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
                <small><?= mb_strtoupper('chap. '. $row['no'])?> : <span class="blue"><?= mb_strtoupper($row['title']) ?></span></small>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
<?php if($row['published'] == 0) {
    $icon = 'glyphicon glyphicon-eye-close red';
    $p = 1;
} else {
    $icon = 'glyphicon glyphicon-eye-open green';
    $p = 0;
} ?>
                <a href="index.php?action=pubPost&id=<?= $row['id'] ?>&p=<?= $p ?>"><span class="<?= $icon ?>"></span></a>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <a href="index.php?action=delPost&id=<?= $row['id'] ?>"<span class="glyphicon glyphicon-remove-sign red"></span></a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
<?php $nbre = 0; if(isset($row['details'])) $nbre = count($row['details']); ?> 
<?php if ($nbre > 0) { ?> 
                <button data-toggle="modal" href="#infos<?= $row['id'] ?>" class="btn btn-badge">Commentaires : <span class="badge"><?= $nbre; ?></span></button>
                <div class="modal" id="infos<?= $row['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span class="glyphicon glyphicon-remove-circle"></span>
                                </button>
                                <h5 class="modal-title">Les commentaires du chapitre <?= $row['no'] ?></h5>
                            </div>
                            <div class="modal-body">
                                <dl>
                                    <dt class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">Commentaires</div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Publi&eacute; (?)</div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Mod&eacute;r&eacute (?)</div>
                                    </dt>
<?php for($j=0; $j<$nbre; $j++) { ?>
                                    <dd>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <img src="public/images/avatars/ico0<?= $row['details'][$j]['avatar'] ?>.png" width="15px">&nbsp;
                                                <?= $row['details'][$j]['author'] ?> a &eacute;crit le <?= $row['details'][$j]['comment_date_fr'] ?>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
<?php if($row['details'][$j]['published'] == 1) { ?>
    <a href="index.php?action=updComment&p=<?= $row['details'][$j]['post_id'] ?>&c=<?= $row['details'][$j]['id'] ?>&t=0">
        <span class="glyphicon glyphicon-thumbs-up register-comment-glyph blue"></span>
    </a>
<?php } else { ?>
    <a href="index.php?action=updComment&p=<?= $row['details'][$j]['post_id'] ?>&c=<?= $row['details'][$j]['id'] ?>&t=1">
        <span class="glyphicon glyphicon-thumbs-down register-comment-glyph red"></span>
    </a>
<?php } ?><!-- END (if($row['details'][$j]['published'] == 1) {) -->
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
<?php if($row['details'][$j]['moderated'] == 1) { ?>
    <span class="glyphicon glyphicon-thumbs-up register-comment-glyph blue"></span>
<?php } else { ?>
    <span class="glyphicon glyphicon-thumbs-down register-comment-glyph red"></span>
<?php } ?><!-- END (if($row['details'][$j]['moderated'] == 1) {) -->                                           
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <?= $row['details'][$j]['comment'] ?>
                                            </div>
                                        </div>
                                    </dd>
                                </dl>
<?php } ?><!-- END (for($j=0; $j<$nbre; $j++) {)  -->   
                            </div>
                        </div>
                    </div>
                </div>
<?php } else { ?>
    <button class="btn btn-badge">Commentaires : <span class="badge"><?= $nbre; ?></span></button>
<?php } ?><!-- END (if ($nbre > 0) {) -->
            </div>
        </div>
    </div>
<?php } ?><!-- END (foreach($array as $row) -->
            </div>
        </section> 
    </div>  

<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');
    