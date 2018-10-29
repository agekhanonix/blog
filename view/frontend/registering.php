<form class="register form-horizontal" action="index.php?action=addMember" method="post">
    <h3 class="register">Si vous voulez &ecirc;tre averti de la publication d'un nouveau chap&icirc;tre de mon dernier livre</h3>
    <h4 class="register">Enregistrez-vous </h4>
    <fieldset class="register">
        <div class="row">
            <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="epseudo" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Pseudo</label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <input type="text" class="form-control has-error has-feedback" id="epseudo" name="pseudo" placeholder="Pseudo" required>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="efirstname" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Prénom</label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <input type="text" class="form-control has-error has-feedback" id="efirstname" name="firstname" placeholder="Prénom" required>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="elastname" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Nom</label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <input type="text" class="form-control has-error has-feedback" id="elastname" name="lastname" placeholder="Nom" required>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="epwd" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Mot de passe</label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <input type="password" class="form-control has-error has-feedback" id="epwd" name="pwd" required>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="econfirm" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Confirmation</label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <input type="password" class="form-control has-error has-feedback" id="econfirm" name="confirm" required>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-success has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="eemail" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Courriel</label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <input type="text" class="form-control has-error has-feedback" id="eemail" name="email" placeholder="jean.forteroche.jf@gmail.com">
                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                </div>
            </div>
        </div>
        <fieldset>
            <legend>Choisissez un avatar</legend>
            <div class="row">
                <div class="col-offset-md-1 col-md-11">
                    <input type="radio" name="avatar" value="1" id="ico01">
                    <img src="public/images/avatars/ico01.png" alt="" class="register">
                    <input type="radio" name="avatar" value="2" id="ico02">
                    <img src="public/images/avatars/ico02.png" alt="" class="register">
                    <input type="radio" name="avatar" value="3" id="ico03">
                    <img src="public/images/avatars/ico03.png" alt="" class="register">
                    <input type="radio" name="avatar" value="4" id="ico04">
                    <img src="public/images/avatars/ico04.png" alt="" class="register">
                </div>
                <div class="col-offset-md-1 col-md-10 col-offset-md-1">
                    <input type="radio" name="avatar" value="5" id="ico05">
                    <img src="public/images/avatars/ico05.png" alt="" class="register">
                    <input type="radio" name="avatar" value="6" id="ico06">
                    <img src="public/images/avatars/ico06.png" alt="" class="register">
                    <input type="radio" name="avatar" value="7" id="ico07">
                    <img src="public/images/avatars/ico07.png" alt="" class="register">
                </div>
            </div>
        </fieldset>     
    </fieldset>
    <div class="row">
        <div class="form-group">
            <button type="submit" id="esubmit" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-ok btn-icon" aria-hidden="true"></span>S'enregister
            </button>
        </div>
    </div>
</form>