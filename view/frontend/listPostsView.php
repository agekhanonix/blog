<?php ob_start(); ?>
    <ol class="breadcrumb row" id="sitemap">
        <li><a href="index.php?action=home">Accueil</a></li>
        <li class="active">Les chapitres du livre</li>
    </ol>
    <div class="content">
        <div id="tabs-chapter"></div>
        <div id="chapter" class="row">

<?php foreach($posts as $post) { ?>
    <section class="chapter col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <dl>
            <dt class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <?= $post['title'] ?>&nbsp;
                    <small>publi&eacute; le <?= $post['creation_date_fr'] ?></small>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <a href="javascript:getComments('<?= $post['id'] ?>', '<?= UNIQID ?>');"><small class="orange">Lire les commentaires</small><button class="btn-default"><span class="glyphicon glyphicon-leaf glyph orange" title="Voir les commentaires pour ce chapitre"></span></button></a>
                </div>
            </dt>
            <dd id="divComment<?= $post['id'] ?>">
                <button data-toggle="modal" href='#infos' class="btn btn-primary">Commentaires</button>
                <div class="modal fade" id="infos">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span class="glyphicon glyphicon-remove-circle"></span>
                                </button>
                                <h4 class="modal-title">Afficher les commentaires et/ou laisser un commentaire</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12" id="shComments<?= $post['id'] ?>">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
<?php $avatar = 1;if(isset($_SESSION['avatar'])) $avatar = $_SESSION['avatar']; ?>
                                        <form action="index.php?action=addComment&id=<?= $post['id'] ?>&avatar=<?= $avatar ?>">
                                            <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <label for="pseudo" class="col-md-3 col-sm-3 col-xs-3 control-label">Pseudo</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" class="form-control" name="pseudo" id="pseudo" require placeholder="Votre pseudo">
                                                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="comment" class="col-md-3 col-sm-3 col-xs-3 control-label">Commentaire</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <textarea id="comment" name="comment" placeholder="Votre commentaire" class="form-control" required></textarea>
                                                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-default btn-sm">
                                                <span class="glyphicon glyphicon-ok btn-icon" aria-hidden="true"></span>Envoyer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-info" data-dismiss="modal" id="btn-modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </dd>
            <dd><?= $post['content'] ?></dd>
        </dl>
    </section>  
<?php } ?>
<?php $posts->closeCursor(); ?>   
            </div>
        </div>
        <script src="public/js/gestShowChapters.js" type="text/javascript"></script>
        <script src="public/js/getComments.js" type="text/javascript"></script>
<?php $content = ob_get_clean(); ?>
    </div><!-- END (content) -->
<?php require('template/template.php'); ?>