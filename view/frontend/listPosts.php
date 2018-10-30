<?php ob_start(); ?>
    <ol class="breadcrumb row" id="sitemap">
        <li><a href="index.php?action=home">Accueil</a></li>
        <li class="active">Les chapitres du livre</li>
    </ol>
    <div class="content">
        <div id="tabs-chapter"></div>
        <div id="chapter" class="row">

<?php foreach($posts as $post) { ?>
    <section class="chapter col-lg-12 col-md-12 col-sm-12 col-xs-12"><h6>&nbsp;</h6>
        <dl>
            <dt class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    Chap.&nbsp;<?= $post['no'] ?>&nbsp;:&nbsp;<?= $post['title'] ?>&nbsp;
                    <small>publi&eacute; le <?= $post['creation_date_fr'] ?></small>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <button data-toggle="modal" data-target="#infos<?= $post['id'] ?>" class="btn btn-default"  onclick="getComments(<?= $post['id'] ?>)">
                        <span class="glyphicon glyphicon-leaf glyph orange" title="Voir les commentaires pour le chapitre <?= $post['no'] ?>"></span>
                        Commentaires
                    </button>
                </div>
            </dt>
            <dd>
                <div class="modal fade" id="infos<?= $post['id'] ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span class="glyphicon glyphicon-remove-circle"></span>
                                </button>
                                <h4 class="modal-title">Les commentaires sur le chapitre : <?= arab2rom($post['no']) ?></h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="rComment<?= $post['id'] ?>">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<?php $avatar = 1;if(isset($_SESSION['avatar'])) $avatar = $_SESSION['avatar']; ?>
                                        <form action="index.php?action=addComment&id=<?= $post['id'] ?>&avatar=<?= $avatar ?>" class="register-comment form-horizontal" method="post" name="myForm<?= $post['id'] ?>">
                                            <h3 class="register-comment">Ecrivez votre commentaire</h3>
                                            <fieldset class="register-comment">
                                                <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label for="pseudo<?= $post['id'] ?>" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label">Pseudo</label>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
<?php $pseudo = '';if(isset($_SESSION['pseudo'])) $pseudo = $_SESSION['pseudo']; ?>
                                                        <input type="text" class="form-control has-error has-feedback" name="pseudo<?= $post['id'] ?>" id="pseudo<?= $post['id'] ?>" required placeholder="Votre pseudo" value="<?= $pseudo ?>">
                                                        <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label for="comment<?= $post['id'] ?>" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label">Commentaire</label>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                        <textarea id="comment<?= $post['id'] ?>" name="comment<?= $post['id'] ?>" placeholder="Votre commentaire" class="form-control has-error has-feedback" required></textarea>
                                                        <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-default btn-sm">
                                                    <span class="glyphicon glyphicon-ok btn-icon" aria-hidden="true"></span>Envoyer
                                                </button>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
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
        <script src="public/js/gestShowChapters.js"></script>
        <script src="public/js/getComments.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('template/template.php'); ?>