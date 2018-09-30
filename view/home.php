<?php $title = 'Mon blog'; ?>
<?php ob_start(); ?>
<?php
    include 'view/home.html';
?>
<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');