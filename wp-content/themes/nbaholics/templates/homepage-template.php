<?php
/* Template Name: Homepage */
?>

<?php get_header(); ?>
<div class="container-fluid">
<?php get_template_part("menus/mainmenu") ?>
</div>

<div class="container bg-white" id="box">
    <?php get_template_part("menus/teamsmenu") ?>
    <div class="row">
        <div class="col-lg-8 pt-1">
            <div id="HomeSlider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators" >
                    <?php
                    $slider_data = get_post_meta($post->ID, '_full_meta',false);
                    $counter_indi=0;
                    $slider_indicators='';
                    foreach($slider_data[0]['sliders'] as $data) {
                        if($counter_indi==0) {
                            $slider_indicators .= '<li data-target="#HomeSlider" data-slide-to="0" class="active"></li>';
                        }else{
                            $slider_indicators .= '<li data-target="#HomeSlider" data-slide-to="' . $counter_indi . '"></li>';
                        }
                        $counter_indi++;
                    }
                    echo $slider_indicators;
                    ?>
                </ol>
                <div class="carousel-inner">
                <?php
                $slider_data = get_post_meta($post->ID, '_full_meta',false);
                $slidernba = '';
                $counter=0;
                 foreach($slider_data[0]['sliders'] as $data) {
                     $src='';
                     if (!empty ($data['icon'])){
                         $src = $data['icon'];
                     }else{
                         $src = get_the_post_thumbnail_url($data['Hot_posts']);
                     }
                     $permalink = get_permalink($data['Hot_posts']);
                     $slider_class=$counter==0?'active':'';

                     $slidernba.= '<div class="carousel-item '.$slider_class.'">';
                     $slidernba.= '<a href="'.$permalink.'">';
                     $slidernba.= '<img class="d-block w-100" src="'.$src.'" alt="" style="height: 300px; width: 700px;">';
                     $slidernba.= '</a>';
                     $slidernba.= '</div>';
                     $counter++;
                 }
                echo $slidernba;
                ?>
                </div>
            </div>
            <div class="pt-5">
                <h2>Todays Nba News</h2>
                    <?php
                    // Define our WP Query Parameters
                     $the_query = new WP_Query( 'posts_per_page=5' );

                    // Start our WP Query ?>
                    <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                            <div class="d-flex flex-column align-items-sm-center flex-md-row border">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>

                                    <div class="p-2 bd-highlight posts-back w-25">
                                        <a href="<?php the_permalink(); ?>">
                                  <?php the_post_thumbnail( 'thumb-400', array( 'class' => 'img-fluid img-hover')); ?>
                                        </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="p-2 bd-highlight">
                                        <p class=""></p>
                                        <p class=""><a class="btn font-weight-bold" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                        <div class="text-muted">
                                            <p><a href="<?php the_author_link(); ?>"</p> <?php the_author();?></a>
                                            / <?php the_date( 'M j' ); ?> / <?php $commentscount = get_comments_number();
                                            echo $commentscount . ' Comments';
                                            ?>
                                          </div>
                                    </div>
                                </div>
                        <?php// Repeat the process and reset once it hits the limit?>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
            </div>
    </div>
        <div class="col-lg-4 pt-1 border">
            <?php get_sidebar("right")?>
        </div>

</div>
</div>

<?php get_footer(); ?>