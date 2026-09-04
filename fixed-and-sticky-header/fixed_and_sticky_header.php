<?php
/*
Plugin Name: Fixed And Sticky Header
Plugin URI: https://arjunthakur2.wordpress.com
Description: Make your website header fixed or sticky while scrolling.
Author: Arjun Thakur
Author URI: https://profiles.wordpress.org/arjunthakur
Version: 1.5.1
License: GPLv2 or later
Text Domain: fixed-and-sticky-header
*/
if ( ! defined( 'ABSPATH' ) ) exit;
if(!class_exists('fixedORsticky_class')):

function fsh_sanitize_selector( $value ) {
    $value = trim( wp_unslash( $value ) );
    if ( '' === $value || strlen( $value ) > 200 ) return '';
    if ( preg_match( '/[\x00-\x1F\x7F<>"\'{};\\\\]/', $value ) ) return '';
    return sanitize_text_field( $value );
}

function fsh_sanitize_color( $value ) {
    $value = trim( wp_unslash( $value ) );
    if ( '' === $value || strlen( $value ) > 100 ) return '';
    if ( preg_match( '/[\x00-\x1F\x7F<>"\'{};\\\\]/', $value ) ) return '';
    if ( ! preg_match( '/^(?:#[0-9a-fA-F]{3,8}|[a-zA-Z]+|(?:rgb|rgba|hsl|hsla)\([0-9a-zA-Z%,.\s+\-]+\))$/', $value ) ) return '';
    return sanitize_text_field( $value );
}

function fsh_sanitize_css_length( $value ) {
    $value = trim( wp_unslash( $value ) );
    if ( '' === $value || strlen( $value ) > 100 ) return '';
    if ( preg_match( '/[\x00-\x1F\x7F<>"\'{};\\\\]/', $value ) ) return '';
    $length = '(?:0|[0-9]+(?:\.[0-9]+)?(?:px|em|rem|%|vh|vw|vmin|vmax|pt|pc|in|cm|mm|ex|ch))';
    if ( ! preg_match( '/^(?:auto|' . $length . ')(?:\s+(?:' . $length . ')){0,3}$/i', $value ) ) return '';
    return sanitize_text_field( $value );
}

class fixedORsticky_class
{ /*AutoLoad Hooks*/
  public function __construct(){
   register_activation_hook(__FILE__, array(&$this, 'fixedORsticky_Activation'));
   add_action('admin_menu',array(&$this, 'optionsPage_fixed'));
   add_action('admin_init',array(&$this, 'handle_settings_save'));
   add_action('wp_head', array(&$this, 'fixedmyscriptfx'));
   add_action('wp_head', array(&$this, 'myPlugincss'));
   }

  /*Install Function and fixed css*/
  public function fixedORsticky_Activation(){
   $plugindefaultstyle = array(
   'default_width_fixed' => '100%',
   'default_padding_fixed' => '0 0',
   'default_margin_fixed' => '0 auto',
   'default_scroll_fixed' => '100',);
   $mypluginoption_fx = get_option('pluginoptions_fx', false);

   if ( false === $mypluginoption_fx || ! is_array( $mypluginoption_fx ) ) {
       add_option('pluginoptions_fx', $plugindefaultstyle);
       return;
   }

   $updated = false;
   foreach ( $plugindefaultstyle as $key => $value ) {
       if ( ! array_key_exists( $key, $mypluginoption_fx ) ) {
           $mypluginoption_fx[$key] = $value;
           $updated = true;
       }
   }

   if ( $updated ) {
       update_option('pluginoptions_fx', $mypluginoption_fx);
   }
   }

  /*Plugin on menu and on Title*/
  public function optionsPage_fixed(){
   add_options_page('Plugin Settings', 'Fixed Header', 'manage_options', 'myplugin_setting',array(&$this, 'myplugin_setting'));
  }

  /*Handle settings before admin page output so redirects can send headers safely*/
  public function handle_settings_save(){
   if ( ! is_admin() || ! isset( $_POST['saveFixedheader'] ) ) {
    return;
   }

   if ( ! current_user_can( 'manage_options' ) ) {
    return;
   }

   check_admin_referer( 'FixedorstickyAction', 'nonceAmountoftime' );

   $myplugins_options = get_option( 'pluginoptions_fx', array() );
   if ( ! is_array( $myplugins_options ) ) {
    $myplugins_options = array();
   }

   $fixedorstickyheader = array_merge(
    $myplugins_options,
    array(
     'class-addfixed-fx'           => isset( $_POST['class-addfixed-fx'] ) ? fsh_sanitize_selector( $_POST['class-addfixed-fx'] ) : '',
     'class-addbackgroundcolor-fx' => isset( $_POST['class-addbackgroundcolor-fx'] ) ? fsh_sanitize_color( $_POST['class-addbackgroundcolor-fx'] ) : '',
     'class-textcolor-fx'          => isset( $_POST['class-textcolor-fx'] ) ? fsh_sanitize_color( $_POST['class-textcolor-fx'] ) : '',
     'fixed-header-height-fx'      => isset( $_POST['fixed-header-height-fx'] ) ? fsh_sanitize_css_length( $_POST['fixed-header-height-fx'] ) : '',
     'fixed-header-padding-fx'     => isset( $_POST['fixed-header-padding-fx'] ) ? fsh_sanitize_css_length( $_POST['fixed-header-padding-fx'] ) : '',
     'fixed-scroll-fx'             => isset( $_POST['fixed-scroll-fx'] ) ? absint( wp_unslash( $_POST['fixed-scroll-fx'] ) ) : 0,
    )
   );

   update_option( 'pluginoptions_fx', $fixedorstickyheader );
   myfixedurl( 'options-general.php?page=myplugin_setting&instruct=1' );
  }

  /*Fixed Checking for userRole*/
  public function myplugin_setting(){
   if(is_admin()): include('dashboard-form.php');
   endif;
  }

  /*My Scripts*/
  public function fixedmyscriptfx(){ $myplugins_options = get_option("pluginoptions_fx"); ?>
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script type="text/javascript"> 
      var fixed_header_class   = <?php echo wp_json_encode( isset( $myplugins_options["class-addfixed-fx"] ) ? $myplugins_options["class-addfixed-fx"] : '' ); ?>;
      var fixed_header_scroll   = <?php echo wp_json_encode( isset( $myplugins_options["fixed-scroll-fx"] ) ? $myplugins_options["fixed-scroll-fx"] : 0 ); ?>;
      jQuery(window).scroll(function(){           
        if(jQuery(document).scrollTop() > fixed_header_scroll){
             jQuery(fixed_header_class).addClass("myfixedHeader");
           }else{
               jQuery(fixed_header_class).removeClass("myfixedHeader");	 
                }
   });</script> <?php
   } 

  
  /*Plugin css*/
   public function myPlugincss() {
    $myplugins_options = get_option("pluginoptions_fx");?><style type="text/css">
    .myfixedHeader{background-color: <?php echo esc_attr( isset( $myplugins_options["class-addbackgroundcolor-fx"] ) ? $myplugins_options["class-addbackgroundcolor-fx"] : "" ); ?>!important;}
    .myfixedHeader, .myfixedHeader a { color: <?php echo esc_attr( isset( $myplugins_options["class-textcolor-fx"] ) ? $myplugins_options["class-textcolor-fx"] : "" ); ?>!important;}
	.myfixedHeader { height: <?php echo esc_attr( isset( $myplugins_options["fixed-header-height-fx"] ) ? $myplugins_options["fixed-header-height-fx"] : "" ); ?>;}
	.myfixedHeader { padding: <?php echo esc_attr( isset( $myplugins_options["fixed-header-padding-fx"] ) ? $myplugins_options["fixed-header-padding-fx"] : "" ); ?>!important;}
    .myfixedHeader {margin: 0 auto !important; width:100% !important; position:fixed; z-index:99999; transition:all 0.7s ease; left:0; right:0; top:0;  }
    <?php echo esc_attr( isset( $myplugins_options["class-addfixed-fx"] ) ? $myplugins_options["class-addfixed-fx"] : "" ); ?>{ transition:all 0.7s ease; }</style>	<?php }
   /*WP Url Redirect*/	
    }
    function myfixedurl($url){
        wp_safe_redirect( esc_url_raw( $url ) );
        exit;
    }
new fixedORsticky_class;
endif;
?>