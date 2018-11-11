<?php ob_start(); ?>
    <ol class="breadcrumb row">
        <li><a href="index.php?action=home">Accueil</a></li>
        <li><a href="index.php?action=listPosts">Chapitres</a></li>
        <li class="active">Ajouter un chapitre</li>
    </ol>
    <div class="content">
        <header class="page-header">
            <h4>Ajouter un chapitre</h4>
        </header>
        <section class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-content">
                    <form action="index.php?action=insPost" method="post" id="form-blog">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <div class="input-group">
                                    <span class="input-group-addon" id="no-input">No : </span>
                                    <input type="number" class="form-control" placeholder="No chapitre" name="no" id="no-input" min="1">
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="title-input">Titre : </span>
                                    <input type="text" class="form-control" placeholder="Titre du chapitre" name="title" id="title-input">
                                </div>
                            </div>
                        </div>
                        <div>
                        <span class="input-group-addon">Contenu :</span>
                        <textarea id="editable" class="form-control" name="content"></textarea>
                        <button type="submit" class="btn btn-success btn-sm" aria-label="Left Align">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Enregister
                        </button>
                    </form>
                </div>
            </div>   
        </section>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');
    