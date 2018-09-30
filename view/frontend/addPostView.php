<?php ob_start(); ?>
<div class="container">
    <ol class="breadcrumb row">
        <li><a href="index.php?action=home">Accueil</a></li>
        <li><a href="index.php?action=listPosts">Articles</a></li>
        <li class="active">Ajouter un article</li>
    </ol>

    <div class="panel panel-success">
        <div class="panel-content">
            <form action="index.php?action=addPostQry" method="post" id="form-blog">
                <div class="input-group">
                    <span class="input-group-addon" id="title-input">Titre : </span>
                    <input type="text" class="form-control" placeholder="Titre de l'article" name="title" id="title-input">
                </div>
                <div>
                    <label for="editable">Contenu :</label>
                    <textarea id="editable" class="form-control" name="content"></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-sm" aria-label="Left Align">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Enregister
                </button>
            </form>
        </div>
    </div>
</div>
</div><!-- END (.container )-->
<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');
    