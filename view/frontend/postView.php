<?php ob_start(); ?>
<div class="container">
    <ol class="breadcrumb row">
        <li><a href="index.php?action=listPosts">Blog</a></li>
        <li class="active">Commentaires</li>
    </ol>
    <header class="page-header">
        <h3><?= $post['title']; ?></h3>
    </header>

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><?= htmlspecialchars($post['title']) ?><br/>
                <small>soumis le <?= $post['creation_date_fr'] ?></small>
            </h3>
            <p>
            <?= nl2br(htmlspecialchars($post['content'])),' '; ?>  
        </div>
        <div class="panel-content">
            <ul class="list-group">
<?php

while ($comment = $comments->fetch()) {
?>
    <li class="list-group-item">
        <strong><?= htmlspecialchars($comment['author']); ?></strong>
        <small>&nbsp;le <?= $comment['comment_date_fr']; ?></small><br/>
        <?= nl2br(htmlspecialchars($comment['comment'])); ?></li>
<?php   
}
?>
            </ul>
        </div>
        <div class="panel-footer">
            &nbsp;{LEVEL1}
        </div>
    </div>
</div><!-- END (.container )-->
<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');