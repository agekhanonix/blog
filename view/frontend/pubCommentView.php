<?php ob_start(); ?>
    <ol class="breadcrumb row">
        <li><a href="index.php?action=home">Accueil</a></li>
        <li><a href="#">Commentaires</a></li>
        <li class="active">Validation</li>
    </ol>
    <nav aria-label="Page navigation">
        <ul class="pager pagination-sm">
<?php $p=1; foreach($array as $row) { ?>
    <li><a href="#"><span id="tab-container<?php echo $p; ?>"><?= $p++ ?></span></a></li>
<?php } ?>
        </ul>
    </nav>
<?php $p=1; foreach($array as $row) { ?>
    <section id="tab-content<?php echo $p++; ?>" class="tabs-content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-3"><?= $row['title'] ?></div>
                    <div class="col-sm-4">Publié le <?= $row['creation_date_fr'] ?></div>
                    <div class="col-sm-offset-3 col-sm-2 badge">Commentaires : <?= (isset($row['details'])) ? count($row['details']) : 0 ?></div>
                </div>
            </div>
            <div class="panel-content">
<?php if(isset($row['details'])) {
    foreach($row['details'] as $comment) { ?>
        <p><?= $comment['author'] ?> a écrit le : <?= $comment['comment_date_fr'] ?></p>
        <p><?= $comment['comment'] ?></p>
<?php 
    $url = '<a href="index.php?action=pubCommentQry&p=' . $row['id'] . '&c=' . $comment['id'] . '&t=';
    $url .= ($comment['publish'] == 0) ? 1 : 0;
    $url .= '"<span class="glyphicon glyphicon-thumbs-';
    $url .= ($comment['publish'] == 0) ? 'down' : 'up';
    $url .= '"</span></a>';
?>
    <p class="text-center">Validation du commentaire : <?php echo $url; ?></p>
<?php }} ?>
            </div>
            <div class="panel-footer text-center">
<?php $icon = ($row['published'] == 1) ? '<span class="glyphicon glyphicon-thumbs-up"></span>' : '<span class="glyphicon glyphicon-thumbs-down"></span>'; ?>
                Article publié : <?= $icon ?>
            </div>
        </div>
    </section>
<?php } ?>

<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');
    