<?php
?>
<!DOCTYPE html>
<body>

        <?php
        if ( have_posts() ) :
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
            endwhile;
        endif;
        ?>


</body>