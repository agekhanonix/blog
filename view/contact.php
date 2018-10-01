<?php ob_start(); ?>
    <div class="container">
        <ol class="breadcrumb row">
            <li><a href="index.php?action=home">Accueil</a></li>
            <li class="active">Contact</li>
        </ol>
        <header class="page-header">
            <h3>Me contacter</h3>
        </header>
        <section class="section">
            <h6 class="text-center contact">
                Vous vous posez des questions ? N'hésitez pas à me contacter directement. 
                Je reviendrai vers vous aussi vite que possible pour y répondre.
            </h6>
            <div class="row">
                <div class="col-md-9 mb-5">
                    <form class="contact" id="contact-form" name="contact-form" action="index.php?action=mail" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon contact">Nom</span>
                                    <input type="text" id="input-name" name="name" class="form-control contact" placeholder="John DOE" required>
                                </div>
                            </div><!-- END (col) -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon contact">Courriel</span>
                                    <input type="email" id="input-email" name="email" class="form-control contact" placeholder="john.doe@ltd.com" required>
                                </div>
                            </div><!-- END (col) -->
                        </div><!-- END (row) -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span  class="input-group-addon contact">Sujet</span>
                                    <input type="text" id="input-subject" name="sujet" class="form-control contact" required>
                                </div>
                            </div><!-- END (col) -->
                        </div><!-- END (col) -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon contact">Votre message</span>
                                    <textarea id="input-message" name="message" row="2" class="form-control contact" required></textarea>
                                </div>
                            </div><!-- END (col) -->
                        </div><!-- END (row) -->
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="submit" id="submit" class="btn btn-sm contact" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Envoyer
                                </button>
                            </div>
                        </div>
                    </form>
                </div><!-- END (col) -->
                <div class="col-md-3 text-left contact">
                    <ul class="list-unstyled mb-0">
                        <li class="contact"><span class="row contact"><i class="fa fa-map-marker fa-w"></i>
                            Sainte-Savine, FR 10300, FRANCE</span>
                        </li>
                        <li class="contact"><span class="row contact"><i class="fa fa-phone mt-4 fa-w"></i>
                            + 33 651 143 924</span>
                        </li>
                        <li class="contact"><span class="row contact"><i class="fa fa-envelope mt-4 fa-w"></i>
                            jean.foutreroche.jf@gmail.com<span>
                        </li>
                    </ul>
                </div><!-- END (col) -->
            </div><!-- END (row) -->
                            
        </section>
    </div><!-- END (.container )-->
<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>