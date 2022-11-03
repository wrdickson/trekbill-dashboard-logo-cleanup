<?php
/**
 * Plugin Name: trekbill-dashboard-logo-cleanup
 * Description: Replace login logo, clean up dashboard.  Requires login-logo.png in wp-content/
 */
 
function trekbill_admin_bar_remove() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');
  }
add_action('wp_before_admin_bar_render', 'trekbill_admin_bar_remove', 0);


add_filter( 'admin_bar_menu', 'trekbill_replace_wordpress_howdy', 25 );
  function trekbill_replace_wordpress_howdy( $wp_admin_bar ) {
    $my_account = $wp_admin_bar->get_node('my-account');
    $newtext = str_replace( 'Howdy,', '', $my_account->title );
    $wp_admin_bar->add_node( array(
      'id' => 'my-account',
      'title' => $newtext,
  ) );
}


function wporg_remove_all_dashboard_metaboxes() {
  // Remove Welcome panel
  remove_action( 'welcome_panel', 'wp_welcome_panel' );
  // Remove the rest of the dashboard widgets
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
  //remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
  //remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');

}
add_action( 'wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes' );

//  remove help tab
add_action( 'admin_head', 'wpdocs_this_screen' );
function wpdocs_this_screen(){
    $current_screen = get_current_screen();
    $current_screen->remove_help_tabs();
}

function remove_footer_admin () 
{
    //echo '<span id="footer-thankyou">Developed by <a href="http://www.designerswebsite.com" target="_blank">Your Name</a></span>';
}
 
add_filter('admin_footer_text', 'remove_footer_admin');

