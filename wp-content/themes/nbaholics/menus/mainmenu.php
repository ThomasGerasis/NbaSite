<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a href="" class="navbar-brand">NbaHolics <img class="logo" src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png'></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
<?php
$args = array(
    'menu_class'        =>  "navbar-nav", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
    'container_class'   =>  "navbar-collapse collapse justify-content-center" ,
    'container_id'      =>  "collapsingNavbar",
    'walker'            =>  new SH_Arrow_Walker_Nav_Menu(), // (object) Instance of a custom walker class.
    'theme_location'    =>  "header-menu", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
);
wp_nav_menu($args);
?>

</nav>