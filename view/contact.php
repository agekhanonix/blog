<form class="form form-horizontal" action="index.php?action=mail" method="post">
    <h3 class="form">Si vous voulez me laisser un message</h3>
    <h4 class="form">Où avez-vous entendu parler de moi ?</h4>
    <fieldset class="form">
        <ul class="list-group">
            <li class="list-group-item form">
                <label for="friend" class="radio">
                    <input type="radio" name="origin" value="1" id="friend"><span class="form">Par un ami</span>
                </label>
            </li>
            <li class="list-group-item form">
                <label for="radio" class="radio">
                    <input type="radio" name="origin" value="2" id="radio"><span class="form">A la radio.</span>
                </label>
            </li>
            <li class="list-group-item form">
                <label for="television" class="radio">
                    <input type="radio" name="origin" value="3" id="television"><span class="form">A la télévision.</span>
                </label>
            </li>
            <li class="list-group-item form">
                <label for="web" class="radio">
                    <input type="radio" name="origin" value="4" id="web"><span class="form">Sur le web.</span>
                </label>
            </li>
            <li class="list-group-item form">
                <label for="other" class="radio">
                    <input type="radio" name="origin" value="5" id="other"><span class="form">Autre ...</span>
                </label>
            </li>
        </ul>
        <div class="row">
            <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Nom</label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Jean Forteroche" 
<?php if(isset($_SESSION['lastName'])) { ?>
    value=" <?= $_SESSION['firstName'] ?> <?= $_SESSION['lastName'] ?>"
<?php } ?>>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="email" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Courriel</label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <input type="text" class="form-control has-error has-feedback" id="email" name="email" placeholder="jean.forteroche.jf@gmail.com" 
<?php if(isset($_SESSION['email'])) { ?>
    value=" <?= $_SESSION['email'] ?>"
<?php } ?>>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="subject" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Objet</label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <input type="text" class="form-control has-error has-feedback" id="subject" name="sujet">
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group has-error has-feedback col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="message" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 control-label">Message</label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <textarea class="form-control has-error has-feedback" id="message" name="message" row="4"></textarea>
                    <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="row">
        <div class="form-group">
            <button type="submit" id="submit" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-ok btn-icon" aria-hidden="true"></span>Envoyer
            </button>
        </div>
    </div>
</form>