<?php ob_start(); ?>
    <ol class="breadcrumb row">
        <li><a href="index.php?action=home">Accueil</a></li>
        <li><a href="#">Membres</a></li>
        <li class="active">R&eacute;vocation</li>
    </ol>
    <div class="content">
        <header class="page-header">
            <h4>R&eacute;vocation d&apos;un membre</h4>
        </header>
        <section class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Les utilisateurs du site</h3>
                </div>
            <div class="list-group">
<?php foreach($array as $row) { ?>
    <div class="list-group-item">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <img src="public/images/avatars/ico0<?= $row['avatar'] ?>.png" width="25px">
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <small><?= mb_strtoupper($row['pseudo']) ?></small>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <small><?= mb_strtoupper($row['lastName']) ?> <?= ucfirst(mb_strtolower($row['firstName'])) ?></small>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <small>Cr&eacute;&eacute; le : <?= $row['creationDate'] ?></small>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 cl-xs-2">
<?php $nbre = 0; if(isset($row['visits'])) $nbre = count($row['visits']); ?>
<?php if($nbre > 0 ) { ?>
    <button data-toggle="modal" href="#infos<?= $row['id'] ?>" class="btn btn-badge">Visites : <span class="badge"><?= $nbre; ?></span></button>
        <div class="modal" id="infos<?= $row['id'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove-circle"></span>
                        </button>
                        <h5 class="modal-title">Ses visites sur le site</h5>
                    </div>
                    <div class="modal-body">
                        <dl>
                            <dt class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Les visites ont eu lieu le :</div>
                            </dt>
<?php for($j=0; $j<$nbre; $j++) { ?>
    <dd class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> - <?= $row['visits'][$j]['date'] ?></div>
    </dd>
<?php } ?><!-- END (for($j=0; $j<$nbre; $j++)) --> 
                        </dl>
                    </div>
                </div>
            </div>
        </div>
<?php } else { ?>
    <button class="btn btn-badge">Visites : <span class="badge"><?= $nbre; ?></span></button>
<?php } ?><!-- END (if ($nbre > 0) {) -->
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
<?php if($row['registred'] == 0) { ?>
    <a href="index.php?action=delMember&id=<?= $row['id'] ?>&p=1">
        <span class="glyphicon glyphicon-leaf green"></span>
    </a>
<?php } else { ?>
    <a href="index.php?action=delMember&id=<?= $row['id'] ?>&p=0">
        <span class="glyphicon glyphicon-erase red"></span>
    </a>
<?php } ?><!-- END (if($row['registred'] == 0)) -->
            </div>
        </div>
    </div>
<?php } ?><!-- END (foreach($array as $row) -->
            </div>
        </section>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>