<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div id="fixed-class-fixed">
<h1>Plugin Settings</h1>
<?php
$fixed_and_sticky_header_options = get_option( 'pluginoptions_fx', array() );
if ( ! is_array( $fixed_and_sticky_header_options ) ) {
    $fixed_and_sticky_header_options = array();
}
?>
<?php if ( get_transient( 'fsh_settings_updated_' . get_current_user_id() ) ) : ?>
    <?php delete_transient( 'fsh_settings_updated_' . get_current_user_id() ); ?>
    <div class="notice notice-success is-dismissible"><p><?php echo esc_html__( 'Settings saved successfully.', 'fixed-and-sticky-header' ); ?></p></div>
<?php endif; ?>


<div id="fixed-content" class="">
  <div id="main-form">
      <form method="post" action=""><?php  wp_nonce_field( 'FixedorstickyAction', 'nonceAmountoftime' ); ?>
       <table class="form-table">
       <tbody>
        <tr><th><span>Add Fixed Header (Class or Id) </span></th>
            <td><input type="text" class="from-control" name="class-addfixed-fx" value="<?php if(!empty($fixed_and_sticky_header_options['class-addfixed-fx'])){ echo esc_attr( $fixed_and_sticky_header_options['class-addfixed-fx'] );}?>" required> <em>Example: .header or #header</em></td>
        </tr>
        
        <tr><th><span>Background Color: </span></th>
            <td><input type="text" class="from-control" name="class-addbackgroundcolor-fx" value="<?php if(!empty($fixed_and_sticky_header_options['class-addbackgroundcolor-fx'])){ echo esc_attr( $fixed_and_sticky_header_options['class-addbackgroundcolor-fx'] );}?>" > <em>Example: #fff</em></td>
        </tr>
        
		<tr><th><span>Text Color:</span></th>
		    <td><input type="text" class="from-control" name="class-textcolor-fx" value="<?php if(!empty($fixed_and_sticky_header_options['class-textcolor-fx'])){ echo esc_attr( $fixed_and_sticky_header_options['class-textcolor-fx'] );}?>" > <em>Example: #000</em></td>
        </tr>
		
		<tr><th><span>Fixed Header Height:</span></th>
            <td><input name="fixed-header-height-fx" value="<?php if(!empty($fixed_and_sticky_header_options['fixed-header-height-fx'])){ echo esc_attr( $fixed_and_sticky_header_options['fixed-header-height-fx'] );}?>"> 
         <em>Example: 100px or blank to default</em></td>
        </tr>
         
		<tr><th><span>Fixed Header Padding:</span></th>
		    <td><input name="fixed-header-padding-fx" value="<?php if(!empty($fixed_and_sticky_header_options['fixed-header-padding-fx'])){ echo esc_attr( $fixed_and_sticky_header_options['fixed-header-padding-fx'] );}else { echo '0px 0px 0px 0px';}?>" ><em> Example: 0px 0px 0px 0px</em></td>
        </tr>
		
		<tr><th><span>Fixed Header Scroll</span></th>
            <td><input type="text" class="header_scroll" name="fixed-scroll-fx" value="<?php if(!empty($fixed_and_sticky_header_options['fixed-scroll-fx'])){ echo esc_attr( $fixed_and_sticky_header_options['fixed-scroll-fx'] );}else{ echo '50';}?>"> <em>Example: 100</em></td>
        </tr>
       </tbody>
        </table>
        <span class="submit"><input type="submit" value="Save Settings" class="button button-primary" id="submit" name="saveFixedheader"></span>
       </form>
</div>
</div>
</div>
