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
            <dt>
                <?= $post['title'] ?>&nbsp;
                <small>publi&eacute; le <?= $post['creation_date_fr'] ?></small>
                <a href="javascript:getComments('<?= $post['id'] ?>');"><span class="glyphicon glyphicon-leaf orange-glyph" title="Voir les commentaires pour ce chapitre"></span></a>
            </dt>
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