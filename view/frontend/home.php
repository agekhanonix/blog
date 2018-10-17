<?php ob_start(); ?>
<?php
    include 'view/frontend/home.html';
?>
<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');