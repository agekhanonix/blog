<?php ob_start(); ?>
    <div class="container">
        <ol class="breadcrumb row">
            <li><a href="index.php?action=home">Accueil</a></li>
            <li><a href="#">Membres</a></li>
            <li class="active">Enregistrement</li>
        </ol>
        <fieldset class="border p-2">
            <legend class="w-auto">Formulaire d'enregistrement</legend>
            <form action="index.php?action=addMemberQry" method="post" id="form-blog">
                <fieldset>
                    <legend class="w-auto red">Obligatoires</legend>
                    <div class="form-inline">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="pseudo">Pseudo</span>
                            <input type="text" class="form-control form-control-sm" id="pseudo" name="pseudo" placeholder="Pseudo" required>
                        </div>
                        <div class="input-group input-group-sm">    
                            <span class="input-group-addon" id="firstname">Prénom</span>
                            <input type="text" class="form-control form-control-sm" id="firstname" name="firstname" placeholder="Prénom" required>
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="lastname">Nom</span>
                            <input type="text" class="form-control form-control-sm" id="lastname" name="lastname" placeholder="Nom" required>
                        </div>
                    </div>
                    <fieldset class="border p-2">
                        <legend class="w-auto">Mot de passe</legend>
                        <div class="form-inline">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="pwd">Mot de passe</span>
                                <input type="password" class="form-control form-control-sm" id="pwd" name="pwd" placeholder="Mot de passe" required>
                            </div>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="confirm">Confirmation</span>
                                <input type="password" class="form-control form-control-sm" id="confirm" name="confirm" placeholder="Confirmez le mot de passe" required>
                            </div>
                        </div>
                    </fieldset>
                </fieldset>
                <fieldset class="border p-2">
                    <legend class="w-auto green">Facultatives</legend>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="email">Courriel</span>
                        <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="john.doe@ldt.com">
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="msn">Id msn</span>
                        <input type="text" class="form-control form-control-sm" id="msn" name="msn">
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="avatar">Avatar</span>
                        <input type="file" class="form-control form-control-sm" id="avatar" name="avatar">
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="url">Url site Web</span>
                        <input type="text" class="form-control form-control-sm" id="url" name="url">
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-success btn-sm" aria-label="Left Align">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Enregister
                </button>
            </form>
        </fieldset>
    </div><!-- END (.container )-->
<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>