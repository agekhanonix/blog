<form class="register form-horizontal" action="index.php?action=addMember" method="post">
    <h3 class="register">Si vous voulez connaître la suite de mon livre</h3>
    <h4 class="register">Enregistrez-vous </h4>
    <fieldset class="register">
        <div class="row">
            <div class="form-group has-error has-feedback">
                <label for="pseudo" class="col-md-3 col-sm-3 col-xs-3  control-label">Pseudo : </label>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <input type="text" class="form-control has-error has-feedback" id="pseudo" name="pseudo" placeholder="Pseudo" required>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback">
                <label for="firstname" class="col-md-3 col-sm-3 col-xs-3 control-label">Prénom : </label>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <input type="text" class="form-control has-error has-feedback" id="firstname" name="firstname" placeholder="Prénom" required>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback">
                <label for="lastname" class="col-md-3 col-sm-3 col-xs-3 control-label">Nom : </label>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <input type="text" class="form-control has-error has-feedback" id="lastname" name="lastname" placeholder="Nom" required>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback">
                <label for="pwd" class="col-md-3 col-sm-3 col-xs-3 control-label">Mot de passe : </label>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <input type="password" class="form-control has-error has-feedback" id="pwd" name="pwd" required>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback">
                <label for="confirm" class="col-md-3 col-sm-3 col-xs-3 control-label">Confirmation : </label>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <input type="password" class="form-control has-error has-feedback" id="confirm" name="confirm" required>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-success has-feedback">
                <label for="email" class="col-md-3 col-sm-3 col-xs-3 control-label">Courriel : </label>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <input type="text" class="form-control has-error has-feedback" id="email" name="email" placeholder="jean.foutreroche.jf@gmail.com">
                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                </div>
            </div>
        </div>
        <fieldset>
            <legend>Choisissez un avatar</legend>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="radio" name="avatar" value="1" id="ico01">
                    <img src="public/images/avatars/ico01.png" class="register">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="radio" name="avatar" value="2" id="ico02">
                    <img src="public/images/avatars/ico02.png" class="register">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="radio" name="avatar" value="3" id="ico03">
                    <img src="public/images/avatars/ico03.png" class="register">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="radio" name="avatar" value="4" id="ico04">
                    <img src="public/images/avatars/ico04.png" class="register">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="radio" name="avatar" value="5" id="ico05">
                    <img src="public/images/avatars/ico05.png" class="register">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="radio" name="avatar" value="6" id="ico06">
                    <img src="public/images/avatars/ico06.png" class="register">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <input type="radio" name="avatar" value="7" id="ico07">
                    <img src="public/images/avatars/ico07.png" class="register">
                </div>
            </div>
        </fieldset>     
    </fieldset>
    <div class="row">
        <div class="form-group">
            <button type="submit" id="submit" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-ok btn-icon" aria-hidden="true"></span>S'enregister
            </button>
        </div>
    </div>
</form>