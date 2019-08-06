<?php

class Category_Posts extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'widget_category_posts',
            _x( 'Category Posts Widget', 'Category Posts Widget' ),
            [ 'description' => __( 'Display a list of posts from a selected category.' ) ]
        );
        $this->alt_option_name = 'widget_category_posts';

        add_action( 'save_post', [$this, 'flush_widget_cache'] );
        add_action( 'deleted_post', [$this, 'flush_widget_cache'] );
        add_action( 'switch_theme', [$this, 'flush_widget_cache'] );
    }


    public function widget( $args, $instance )
    {
        $cache = [];
        if ( ! $this->is_preview() ) {
            $cache = wp_cache_get( 'widget_cat_posts', 'widget' );
        }

        if ( ! is_array( $cache ) ) {
            $cache = [];
        }

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();

        $title          = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Category Posts' );
        /** This filter is documented in wp-includes/default-widgets.php */
        $title          = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $First_title    =$instance['First_title'];
        $Second_title    =$instance['Second_title'];
        $Third_title    =$instance['Third_title'];
        $first_cat_id   = $instance['first_cat_id'];
        $second_cat_id   = $instance['second_cat_id'];
        $third_cat_id   = $instance['third_cat_id'];

        /**
         * Filter the arguments for the Category Posts widget.
         *
         */
        $query_args = [
            'posts_per_page'    => 5,
            'fields'            =>'ids',
            'cat'               => $first_cat_id,
        ];
        $q1 = new WP_Query( apply_filters( 'category_posts_args', $query_args ) );

        $query_args = [
            'posts_per_page'    => 5,
            'fields'            =>'ids',
            'cat'               => $second_cat_id,
        ];
        $q2 = new WP_Query( apply_filters( 'category_posts_args', $query_args ) );

            $query_args = [
                'posts_per_page'    => 5,
                'fields'            =>'ids',
                'cat'               => $third_cat_id,
            ];
        $q3 = new WP_Query( apply_filters( 'category_posts_args', $query_args ) );

        ?>

           <div class="bg-secondary d-flex w-100 flex-column align-items-sm-center flex-md-row justify-content-center
             order-0 pt-0">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="btn pills text-uppercase font-weight-bold active" id="pills-first-tab" data-toggle="pill" href="#pills-First" role="tab" aria-controls="pills-First" aria-selected="true"><?php echo $First_title; ?></a>
          </li>
          <li class="nav-item">
            <a class="btn pills text-uppercase font-weight-bold" id="pills-second-tab" data-toggle="pill" href="#pills-Second" role="tab" aria-controls="pills-Second" aria-selected="false"><?php echo $Second_title; ?></a>
          </li>
          <li class="nav-item">
            <a class="btn pills text-uppercase font-weight-bold" id="pills-third-tab" data-toggle="pill" href="#pills-Third" role="tab" aria-controls="pills-Third" aria-selected="false"><?php echo $Third_title; ?></a>
          </li>
           </ul>
           </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-First" role="tabpanel" aria-labelledby="pills-first-tab">
        <?php
        if( $q1->have_posts() ) {
            while( $q1->have_posts() ) {
                $q1->the_post();

                ?>
                <div class="d-flex flex-column align-items-sm-center flex-md-row">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="p-2 bd-highlight">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid img-hover') ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="p-2 bd-highlight">
                        <p class=""><a class="text-muted btn" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        <p class="text-muted"><?php the_excerpt(); ?></p>
                    </div>
                    </div>
                <?php
            }
            wp_reset_postdata();
        }
        ?>
          </div>
           <div class="tab-pane fade" id="pills-Second" role="tabpanel" aria-labelledby="pills-second-tab">
          <?php
        if( $q2->have_posts() ) {
            while( $q2->have_posts() ) {
                $q2->the_post(); ?>
                <div class="d-flex flex-column align-items-sm-center flex-md-row">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="p-2 bd-highlight">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid img-hover') ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="p-2 bd-highlight">
                        <p class=""><a class="text-muted btn" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        <p class="text-muted"><?php the_excerpt(); ?></p>
                    </div>
                    </div>
            <?php
            }
            wp_reset_postdata();
        }
         ?>
          </div>
          <div class="tab-pane fade" id="pills-Third" role="tabpanel" aria-labelledby="pills-third-tab">
          <?php
        if( $q3->have_posts() ) {
            while( $q3->have_posts() ) {
                $q3->the_post(); ?>
                <div class="d-flex flex-column align-items-sm-center flex-md-row">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="p-2 bd-highlight">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid img-hover') ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="p-2 bd-highlight">
                        <p class=""><a class="text-muted btn" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        <p class="text-muted"><?php the_excerpt(); ?></p>
                    </div>
                </div>
            <?php
            }
            wp_reset_postdata();
        }
?>
           </div>
        <?php
        echo $args['after_widget'];

        if ( ! $this->is_preview() ) {
            $cache[ $args['widget_id'] ] = ob_get_flush();
            wp_cache_set( 'widget_cat_posts', $cache, 'widget' );
        } else {
            ob_end_flush();
        }
    }

    public function update( $new_instance, $old_instance )
    {
        $instance                   = $old_instance;
        $instance['First_title']    = strip_tags( $new_instance['First_title'] );
        $instance['Second_title']   = strip_tags( $new_instance['Second_title'] );
        $instance['Third_title']    = strip_tags( $new_instance['Third_title'] );
        $instance['first_cat_id']   = (int) $new_instance['first_cat_id'];
        $instance['second_cat_id']  = (int) $new_instance['second_cat_id'];
        $instance['third_cat_id']   = (int) $new_instance['third_cat_id'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_category_posts']) )
            delete_option('widget_category_posts');

        return $instance;
    }

    public function flush_widget_cache()
    {
        wp_cache_delete('widget_cat_posts', 'widget');
    }

    public function form( $instance )
    {
        $First_title       = isset($instance['First_title'])? $instance['First_title'] : false;
        $Second_title      = isset($instance['Second_title'])? $instance['Second_title'] : false;
        $Third_title       = isset($instance['Third_title'])? $instance['Third_title'] : false;
        $first_cat_id      = isset( $instance['first_cat_id'] ) ? absint( $instance['first_cat_id'] ) : 1;
        $second_cat_id     = isset( $instance['second_cat_id'] ) ? absint( $instance['second_cat_id'] ) : 1;
        $third_cat_id      = isset( $instance['third_cat_id'] ) ? absint( $instance['third_cat_id'] ) : 1;
        ?>
              <p>
             <label for="<?php echo $this->get_field_id('First_title'); ?>"><?php _e( 'Enter a title:' )?></label>
            <input id="<?php echo $this->get_field_id( 'First_title' ); ?>" name="<?php echo $this->get_field_name( 'First_title' ); ?>" type="text" value="<?php echo $First_title; ?>"/>
            </p>
            <p>
            <label for="<?php echo $this->get_field_id('first_cat_id'); ?>"><?php _e( 'Choose Category:' )?></label>
            <select id="<?php echo $this->get_field_id('first_cat_id'); ?>" name="<?php echo $this->get_field_name('first_cat_id'); ?>">
                <?php
                $this->categories = get_categories();
                foreach ( $this->categories as $cat ) {
                    $selected = ( $cat->term_id == esc_attr( $first_cat_id ) ) ? ' selected = "selected" ' : '';
                    $option = '<option '.$selected .'value="' . $cat->term_id;
                    $option = $option .'">';
                    $option = $option .$cat->name;
                    $option = $option .'</option>';
                    echo $option;
                }
                ?>
            </select>
        </p>
           <p>
             <label for="<?php echo $this->get_field_id('Second_title'); ?>"><?php _e( 'Enter a title:' )?></label>
            <input id="<?php echo $this->get_field_id( 'Second_title' ); ?>" name="<?php echo $this->get_field_name( 'Second_title' ); ?>" type="text" value="<?php echo $Second_title; ?>"/>
            </p>
        <p>
            <label for="<?php echo $this->get_field_id('second_cat_id'); ?>"><?php _e( 'Choose Category :' )?></label>
            <select id="<?php echo $this->get_field_id('second_cat_id'); ?>" name="<?php echo $this->get_field_name('second_cat_id'); ?>">
                <?php
                $this->categories = get_categories();
                foreach ( $this->categories as $cat ) {
                    $selected = ( $cat->term_id == esc_attr( $second_cat_id ) ) ? ' selected = "selected" ' : '';
                    $option = '<option '.$selected .'value="' . $cat->term_id;
                    $option = $option .'">';
                    $option = $option .$cat->name;
                    $option = $option .'</option>';
                    echo $option;
                }
                ?>
            </select>
        </p>
           <p>
             <label for="<?php echo $this->get_field_id('Third_title'); ?>"><?php _e( 'Enter a title:' )?></label>
            <input id="<?php echo $this->get_field_id( 'Third_title' ); ?>" name="<?php echo $this->get_field_name( 'Third_title' ); ?>" type="text" value="<?php echo $Third_title; ?>"/>
            </p>
        <p>
            <label for="<?php echo $this->get_field_id('third_cat_id'); ?>"><?php _e( 'Choose Category:' )?></label>
            <select id="<?php echo $this->get_field_id('third_cat_id'); ?>" name="<?php echo $this->get_field_name('third_cat_id'); ?>">
                <?php
                $this->categories = get_categories();
                foreach ( $this->categories as $cat ) {
                    $selected = ( $cat->term_id == esc_attr( $third_cat_id ) ) ? ' selected = "selected" ' : '';
                    $option = '<option '.$selected .'value="' . $cat->term_id;
                    $option = $option .'">';
                    $option = $option .$cat->name;
                    $option = $option .'</option>';
                    echo $option;
                }
                ?>
            </select>
        </p>
        <?php
    }

}

add_action( 'widgets_init', function ()
{
    register_widget( 'Category_Posts' );
});

