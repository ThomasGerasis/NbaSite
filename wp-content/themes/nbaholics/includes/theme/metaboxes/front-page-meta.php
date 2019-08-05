<?php global $wpalchemy_media_access; ?>
<?php echo do_shortcode('[slider id="nbaslider"]'); ?>
<style type="text/css">
    td.sort_td:hover{cursor: move;}
</style>
>
<div class="my_meta_control metabox">
    <p><a href="#" class="docopy-sliders button">New Slide</a></p>

    <table border="1" cellspacing="0" cellpadding="3" class="sliders_table" style="width: 100%; margin-top: 10px; margin-bottom: 20px;">
        <tr>
            <th>Order</th>
            <th>Select Post From Hot Category posts</th>
            <th>Image Url</th>
            <th>Image Preview</th>
            <th>Delete Slide</th>
            <th>Add New image</th>
        </tr>
        <tbody>
<?php $my_counter = 0;?>
<?php while($metabox->have_fields_and_multi('sliders',array('length' => 1, 'limit' => 10))): ?>
    <?php $metabox->the_group_open('tr'); ?>
    <?php $metabox->the_field('order'); ?>
    <td class="slider_td">
        <div class="slider_order" style="text-align: center"><?php echo ($my_counter + 1);?></div>
        <input type="text" class="faqs_sort_order" style="display: none;" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
    </td>
    <td>
        <?php $metabox->the_field('Hot_posts',WPALCHEMY_FIELD_HINT_SELECT); ?>
        <select name="<?php $metabox->the_name(); ?>" class="sle">
        <?php
        $args = array(
            'category_name' => 'Hot',
            'post_type' => 'post'
        );
        $post_query = new WP_Query($args);
        if($post_query->have_posts() ) {
            while($post_query->have_posts() ) {
                $post_query->the_post();
                ?>
                <option value="<?php echo get_the_ID(); ?>"<?php $metabox->the_select_state($post->ID); ?>><?php the_title();?></option>
                <?php
            }
        }
        ?>
        </select>
    </td>
    <td> <input type="text" id="<?php $metabox->the_name('icon'); ?>" name="<?php $metabox->the_name('icon'); ?>" value="<?= $metabox->get_the_value('icon')?>" class="mr-1 imga" /></td>
    <td>  <img src="<?= $metabox->get_the_value('icon')?$metabox->get_the_value('icon'):get_the_post_thumbnail_url($metabox->get_the_value('Hot_posts')); ?>" width="80" class="mr-1"></td>
    <td style="text-align: center;"><a href="#" class="dodelete button"><span class="dashicons dashicons-trash" style="pointer-events: none;"></span></a></td>
<?php $metabox->the_field('icon')?>
    <td><button data-dest-selector="#<?php $metabox->the_name(); ?>" class="btn btn-primary btn-sm add-slider-button">Add Image</button></td>
    <?php $my_counter++;?>
    <?php $metabox->the_group_close(); ?>
<?php endwhile; ?>
        </tbody>
    </table>
    <hr/>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){

        $(".last.tocopy input.faqs_sort_order").prop("disabled", true);
        $(".last.tocopy select.sle").prop("disabled", true);
        $(".last.tocopy input.imga").prop("disabled", true);

        $('.docopy-sliders').click(function(){
            $(".wpa_group").not(".last.tocopy").each(function () {
                $(this).find('select.sle').prop('disabled',false);
                $(this).find('input.faqs_sort_order').prop('disabled',false);
                $(this).find('input.imga').prop('disabled',false);
            });
        });

        $( ".sliders_table" ).find('tbody').sortable( {
            dropOnEmpty: false,
            cursor: "move",
            handle: ".slider_td",
            update: function( event, ui ) {
                $(this).children().each(function(index) {
                    $(this).find('.slider_order').html(index + 1);
                    $(this).find('input.faqs_sort_order').val(index + 1);
                });
            }
        });
        var dest_selector;

        var media_window = wp.media({
            title: 'Add Media',
            library: {type: 'image'},
            multiple: false,
            button: {text: 'Add'}
        });
        media_window.on('select', function() {
            var first = media_window.state().get('selection').first().toJSON();
            jQuery(dest_selector).val(first.url);
            dest_selector = null; // reset
        });
        function esc_selector( selector ) {
            return selector.replace( /(:|\.|\[|\]|,)/g, "\\$1" );
        }
        $('.my_meta_control').on('click', '.add-slider-button', function(e){
            e.preventDefault();
            dest_selector = esc_selector($(this).data('dest-selector')); // set
            media_window.open();
        });
    });
</script>
