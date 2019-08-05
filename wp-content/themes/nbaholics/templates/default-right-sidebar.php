<?php
/* Template Name: Right-Sidebar-Default */
?>

<?php get_header(); ?>
<div class="container-fluid">
    <?php get_template_part("menus/mainmenu") ?>
</div>

<div class="container bg-white" id="box">
    <?php get_template_part("menus/teamsmenu") ?>
    <div class="row">

        <div class="col-lg-4 pt-1 border">
            <?php get_sidebar("right")?>

        </div>

    </div>
</div>

<?php get_footer(); ?>
