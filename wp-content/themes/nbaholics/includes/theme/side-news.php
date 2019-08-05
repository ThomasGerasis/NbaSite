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
        $number         = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number ) {
            $number = 5;
        }

        $first_cat_id   = $instance['first_cat_id'];
        $second_cat_id   = $instance['second_cat_id'];
        $third_cat_id   = $instance['third_cat_id'];

        /**
         * Filter the arguments for the Category Posts widget.
         *
         */
            $query_args = [
                'posts_per_page'    => $number,
                'cat'               => $first_cat_id,$second_cat_id,$third_cat_id,
            ];
        $q = new WP_Query( apply_filters( 'category_posts_args', $query_args ) );

        if( $q->have_posts() ) {

            echo $args['before_widget'];
            if ( $title ) {
                //echo $args['before_title'] . $title . $args['after_title'];
            }
?>
            <div class="bg-secondary d-flex w-100 flex-column align-items-sm-center flex-md-row justify-content-center
             order-0 pt-0">
                <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" class="btn" href="#Category1">ΡΟΗ</a></li>
                    <li><a data-toggle="pill" class="btn" href="#Category2">LATEST</a></li>
                    <li><a data-toggle="pill" class="btn" href="#Category3">ΕΙΔΗΣΕΙΣ</a></li>
                </ul>

                <div class="tab-content">
                    <div id="Category1" class="tab-pane fade in active">
                        <h3>HOME</h3>
                        <p>Some content.</p>
                    </div>
                    <div id="Category2" class="tab-pane fade">
                        <h3>Menu 1</h3>
                        <p>Some content in menu 1.</p>
                    </div>
                    <div id="Category3" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Some content in menu 2.</p>
                    </div>
                </div>
            </div>

            <?php
            while( $q->have_posts() ) {
                $q->the_post(); ?>

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
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['number']         = (int) $new_instance['number'];
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
        $title             = isset($instance['title'])? $instance['title'] : false;
        $number            = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $first_cat_id      = isset( $instance['first_cat_id'] ) ? absint( $instance['first_cat_id'] ) : 1;
        $second_cat_id     = isset( $instance['second_cat_id'] ) ? absint( $instance['second_cat_id'] ) : 1;
        $third_cat_id      = isset( $instance['third_cat_id'] ) ? absint( $instance['third_cat_id'] ) : 1;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Enter a title:' )?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('first_cat_id'); ?>"><?php _e( 'First Category Name:' )?></label>
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
            <label for="<?php echo $this->get_field_id('second_cat_id'); ?>"><?php _e( 'Second Category Name:' )?></label>
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
            <label for="<?php echo $this->get_field_id('third_cat_id'); ?>"><?php _e( 'Third Category Name:' )?></label>
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

        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
        </p>

        <?php
    }

}

add_action( 'widgets_init', function ()
{
    register_widget( 'Category_Posts' );
});