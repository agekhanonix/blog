<?php ob_start(); ?>
    <ol class="breadcrumb row" id="sitemap">
        <li><a href="index.php?action=home">Accueil</a></li>
        <li class="active">Les chapitres du livre</li>
    </ol>
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <nav aria-label="Page navigation">
                    <ul class="pager pagination-sm">
<?php $p=1; foreach($posts as $post) { ?>
    <li><a href="#"><span id="chapter<?php echo $p; ?>"><?= $p++ ?></span></a></li>
<?php } ?>
                    </ul>
                </nav>    
            </div>
        </div>
<?php $posts->closeCursor(); ?>
<?php $content = ob_get_clean(); ?>
    </div><!-- END (content) -->

<?php require('template/template.php'); ?>