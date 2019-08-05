<?php /**
 * Register our sidebars and widgetized areas.
 *
 */
function nbaholics_widgets_init() {

	register_sidebar( array(
		'name'          => 'Right Sidebar',
		'id'            => 'home_right',
		'before_widget' => '<div id="%1$s" class="sidebar-block desktop-large desktop-medium desktop-small %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="block-title text-uppercase text-bold pt-7 pb-3 mt-0">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => 'Left Sidebar',
		'id'            => 'home_left',
		//'before_widget' => '<div id="%1$s" class="sidebar-block %2$s">',
		'before_widget' => '<div id="%1$s" class="%2$s desktop-large desktop-medium desktop-small">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="block-title text-uppercase  text-bold pt-7 pb-3 mt-0">',
		'after_title'   => '</h3>',
	) );
//	register_sidebar( array(
//		'name'          => 'Right Sidebar Review',
//		'id'            => 'home_right_review',
//		'before_widget' => '<div id="%1$s" class="sidebar-block desktop-large desktop-medium desktop-small %2$s">',
//		'after_widget'  => '</div>',
//		'before_title'  => '<h3 class="block-title">',
//		'after_title'   => '</h3>',
//	) );
//	register_sidebar( array(
//		'name'          => 'Header Advertisement',
//		'id'            => 'head_ad',
//		'before_widget' => '<div id="%1$s" class="header-banner desktop-large desktop-medium visible-lg-block %2$s">',
//		'after_widget'  => '</div>',
//		'before_title'  => '<h3 class="block-title">',
//		'after_title'   => '</h3>',
//	) );
//	register_sidebar( array(
//		'name'          => 'Header Advertisement for smaller screens',
//		'id'            => 'head_ad_md',
//		'before_widget' => '<div id="%1$s" class="header-banner desktop-small visible-xs-block visible-sm-block visible-md-block %2$s">',
//		'after_widget'  => '</div>',
//		'before_title'  => '<h3 class="block-title">',
//		'after_title'   => '</h3>',
//	) );
//	register_sidebar( array(
//		'name'          => 'Home Advertisement for mobile',
//		'id'            => 'home_mob',
//		'before_widget' => '<div id="%1$s" class="sticky-banner desktop-xxsmall desktop-xsmall %2$s">',
//		'after_widget'  => '</div>',
//		'before_title'  => '<h3 class="block-title ">',
//		'after_title'   => '</h3>',
//	) );
	register_sidebar(array(
		'name' => 'Right Skin Ad',
		'id'   => 'right-skin-ad-area',
		'description'   => 'Place for right skin Ad',
		'before_widget' => '<div id="%1$s" class="skin-banner desktop-large %2$s">' ,
		'after_widget' => '</div>' ,
		'before_title' => '' ,
		'after_title' => '' ,
	));
	register_sidebar(array(
	'name' => 'Left Skin Ad',
		'id'   => 'left-skin-ad-area',
		'description'   => 'Place for left skin Ad',
		'before_widget' => '<div id="%1$s" class="skin-banner desktop-large  %2$s">' ,
		'after_widget' => '</div>' ,
		'before_title' => '' ,
		'after_title' => '' ,
	));
//	register_sidebar(array(
//		'name' => 'Sticky Banner bottom of page',
//		'id'   => 'sticky-bottom',
//		'description'   => 'Sticky Banner placed at the bottom of the page following scrolling',
//		'before_widget' => '<div id="%1$s" class="desktop-xxsmall desktop-xsmall %2$s">' ,
//        'after_widget' => '</div>' ,
//        'before_title' => '' ,
//        'after_title' => '' ,
//	));

}
add_action( 'widgets_init', 'nbaholics_widgets_init' );
?>

