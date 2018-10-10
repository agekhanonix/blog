<?php ob_start(); ?>
<?php
    include 'view/frontend/polities.html';
?>
<?php $content = ob_get_clean(); ?>
<?php require('template/template.php');