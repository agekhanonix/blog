<?php ob_start(); ?>
        <ol class="breadcrumb row">
            <li><a href="index.php?action=home">Accueil</a></li>
            <li><a href="#">Membres</a></li>
            <li class="active">Revocation</li>
        </ol>

        <div class="panel panel-success">
            <div class="panel-heading row">
                <h6 class="text-center">    
                    <span class="col-md-1">PSEUDO</span>
                    <span class="col-md-2">NOM</span>
                    <span class="col-md-2">PRENOM</span>
                    <span class="col-md-3">CREATION</span>
                    <span class="col-md-3">VISITE</span>
                    <span class="col-md-1">ACTIF</span>
                </h6>
            </div><!-- END (.panel-header ) -->
            <div class="panel-content">
                <ol class="list-group">
<?php
while($member = $members->fetch()) {
?>
    <li class="list-group-item row">
        <small>
            <span class="col-md-1"><?= htmlspecialchars($member['members_pseudo']) ?></span>
            <span class="col-md-2"><?= htmlspecialchars($member['members_lastName']) ?></span>
            <span class="col-md-2"><?= htmlspecialchars($member['members_firstName']) ?></span>
            <span class="col-md-3 text-center"><?= $member['creation_date_fr'] ?></span>
            <span class="col-md-3 text-center"><?= $member['lastVisit_fr'] ?></span>
<?php
$url = ($member['members_registred'] == 1) ? 
    '<a href="index.php?action=delMemberQry&id=' . $member['members_id'] . '&p=0"><span class="glyphicon glyphicon-thumbs-down"></span></a>' :
    '<a href="index.php?action=delMemberQry&id=' . $member['members_id'] . '&p=1"><span class="glyphicon glyphicon-thumbs-up"></span></a>';
?>
            <span class="col-md-1 text-center"><?= $url ?></</span>
        </small>
    </li>
<?php
}
$members->closeCursor();
?>
                </ol>
            </div><!-- END (.panel-content) -->
        </div><!-- END (.panel-default) --> 
<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>