<?php ob_start(); ?>
    <ol class="breadcrumb row">
        <li><a href="index.php?action=home">Accueil</a></li>
        <li><a href="index.php?action=listPosts">Blog</a></li>
        <li><a href="index.php?action=post&id=<?= $postId ?>">Commentaires</a></li>
        <li class="active">Laisser un commentaire</li>
    </ol>
    <header class="page-header">
        <h3><?= $post['title']; ?></h3>
    </header>

    <div class="panel panel-success">
        <div class="panel-heading">
            <?= nl2br(htmlspecialchars($post['content'])),' '; ?><br/><br/>
            <small>soumis le <?= $post['creation_date_fr'] ?></small>
        </div>
        <div class="panel-content">
            <form action="index.php?action=addCommentQry&amp;id=<?= $post['id'] ?>" method="post" id="form-blog">
                <div>
                    <label for="comment">Commentaire :</label>
                    <textarea id="comment" class="form-control" name="comment"></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-sm" aria-label="Left Align">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Enregister
                </button>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');
    