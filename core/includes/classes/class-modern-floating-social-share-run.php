<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This class is used to bring your plugin to life. 
 * All the other registered classed bring features which are
 * controlled and managed by this class.
 * 
 * Within the add_hooks() function, you can register all of 
 * your WordPress related actions and filters as followed:
 * 
 * add_action( 'my_action_hook_to_call', array( $this, 'the_action_hook_callback', 10, 1 ) );
 * or
 * add_filter( 'my_filter_hook_to_call', array( $this, 'the_filter_hook_callback', 10, 1 ) );
 * or
 * add_shortcode( 'my_shortcode_tag', array( $this, 'the_shortcode_callback', 10 ) );
 * 
 * Once added, you can create the callback function, within this class, as followed: 
 * 
 * public function the_action_hook_callback( $some_variable ){}
 * or
 * public function the_filter_hook_callback( $some_variable ){}
 * or
 * public function the_shortcode_callback( $attributes = array(), $content = '' ){}
 * 
 * 
 * HELPER COMMENT END
 */

/**
 * Class Modern_Floating_Social_Share_Run
 *
 * Thats where we bring the plugin to life
 *
 * @package		MODERNFLOA
 * @subpackage	Classes/Modern_Floating_Social_Share_Run
 * @author		Shebin KP
 * @since		1.0.0
 */
class Modern_Floating_Social_Share_Run{

	/**
	 * Our Modern_Floating_Social_Share_Run constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct(){
		$this->add_hooks();
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOKS
	 * ###
	 * ######################
	 */

	/**
	 * Registers all WordPress and plugin related hooks
	 *
	 * @access	private
	 * @since	1.0.0
	 * @return	void
	 */
	private function add_hooks(){
	
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts_and_styles' ), 20 );
		add_action( 'wp_ajax_nopriv_my_demo_ajax_call', array( $this, 'my_demo_ajax_call_callback' ), 20 );
		add_action( 'wp_ajax_my_demo_ajax_call', array( $this, 'my_demo_ajax_call_callback' ), 20 );
		add_action('wp_footer', array( $this, 'Socialshare_floating_button' )  ,20);
		add_action( 'admin_menu', array( $this, 'MF_Social_share_options' )  ,20 );
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOK CALLBACKS
	 * ###
	 * ######################
	 */


	/**
	 * Enqueue the frontend related scripts and styles for this plugin.
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	public function enqueue_frontend_scripts_and_styles() {
		wp_enqueue_style( 'modernfloa-frontend-styles', MODERNFLOA_PLUGIN_URL . 'core/includes/assets/css/frontend-styles.css', array(), MODERNFLOA_VERSION, 'all' );
		wp_enqueue_script( 'modernfloa-frontend-scripts', MODERNFLOA_PLUGIN_URL . 'core/includes/assets/js/frontend-scripts.js', array( 'jquery' ), MODERNFLOA_VERSION, true );
		wp_localize_script( 'modernfloa-frontend-scripts', 'modernfloa', array(
			'demo_var'   		=> __( 'This is some demo text coming from the backend through a variable within javascript.', 'modern-floating-social-share' ),
			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
			'security_nonce'	=> wp_create_nonce( "your-nonce-name" ),
		));
	}


	/**
	 * The callback function for my_demo_ajax_call
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */
	public function my_demo_ajax_call_callback() {
		check_ajax_referer( 'your-nonce-name', 'ajax_nonce_parameter' );

		$demo_data = isset( $_REQUEST['demo_data'] ) ? sanitize_text_field( $_REQUEST['demo_data'] ) : '';
		$response = array( 'success' => false );

		if ( ! empty( $demo_data ) ) {
			$response['success'] = true;
			$response['msg'] = __( 'The value was successfully filled.', 'modern-floating-social-share' );
		} else {
			$response['msg'] = __( 'The sent value was empty.', 'modern-floating-social-share' );
		}

		if( $response['success'] ){
			wp_send_json_success( $response );
		} else {
			wp_send_json_error( $response );
		}

		die();
	}

	/**
	 * The callback function for Socialshare_floating_button
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @return	void
	 */


	 function Socialshare_floating_button(){
		$wa_number = get_option('social_share_link', '#');
		$wa_msg = get_option('social_share_msg', 'Hi');
		if($wa_number != '#'):
		echo '<a href="https://web.whatsapp.com/send?text='.$wa_msg.'&phone='.$wa_number.'" class="floating-btn share" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="82" height="82" viewBox="0 0 82 82">
						<defs>
						<filter id="Path_2145" x="0" y="0" width="82" height="82" filterUnits="userSpaceOnUse">
							<feOffset dy="3" input="SourceAlpha"/>
							<feGaussianBlur stdDeviation="3" result="blur"/>
							<feFlood flood-opacity="0.161"/>
							<feComposite operator="in" in2="blur"/>
							<feComposite in="SourceGraphic"/>
						</filter>
						</defs>
						<g id="Group_495" data-name="Group 495" transform="translate(-1400 411)">
						<g transform="matrix(1, 0, 0, 1, 1400, -411)" filter="url(#Path_2145)">
							<path id="Path_2145-2" data-name="Path 2145" d="M32,0A32,32,0,1,1,0,32,32,32,0,0,1,32,0Z" transform="translate(9 6)" fill="#14c656"/>
						</g>
						<path id="Union_8" data-name="Union 8" d="M0,31.686H0L2.238,23.55A15.7,15.7,0,0,1,15.908,0a15.719,15.719,0,0,1,11.16,4.6,15.572,15.572,0,0,1,4.616,11.108,15.761,15.761,0,0,1-15.776,15.7H15.9A15.856,15.856,0,0,1,8.363,29.5L0,31.686Zm9.23-4.743a13.138,13.138,0,0,0,6.674,1.82h.005a13.1,13.1,0,0,0,13.112-13.05A13.083,13.083,0,0,0,15.913,2.652,13.046,13.046,0,0,0,4.8,22.647l.312.494L3.788,27.956l4.963-1.3ZM16.235,22.2C12.228,20.622,9.7,16.534,9.5,16.272a7.616,7.616,0,0,1-1.609-4.059A4.392,4.392,0,0,1,9.272,8.94a1.451,1.451,0,0,1,1.051-.491c.263,0,.526,0,.755.009.281.012.592.025.887.678.35.776,1.116,2.717,1.215,2.913a.718.718,0,0,1,.033.687,2.7,2.7,0,0,1-.393.654c-.2.229-.415.511-.592.687-.2.2-.4.408-.173.8A11.852,11.852,0,0,0,14.248,17.6a10.8,10.8,0,0,0,3.17,1.948c.394.2.625.164.854-.1s.985-1.146,1.248-1.538.526-.328.887-.2,2.3,1.08,2.693,1.276.657.294.756.458a3.264,3.264,0,0,1-.23,1.865,3.979,3.979,0,0,1-2.66,1.866,7.518,7.518,0,0,1-.805.065A11.3,11.3,0,0,1,16.235,22.2Z" transform="translate(1425 -388.843)" fill="#fff"/>
						<circle id="Ellipse_31" data-name="Ellipse 31" cx="5" cy="5" r="5" transform="translate(1458 -401)" fill="red"/>
						</g>
					</svg>
				</a>';
		endif;


	 }
	
	/** Step 1. */
	function MF_Social_share_options() {
		add_options_page( 'MF Social Share Options', 'MF Social Share','manage_options', 'my-unique-identifier', array( $this , 'my_plugin_options' ));
	}

	function my_plugin_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		if (isset($_POST['social_share_link'])) {
			$value = $_POST['social_share_link'];
			update_option('social_share_link', $value);
		}
		if (isset($_POST['social_share_msg'])) {
			$msg = $_POST['social_share_msg'];
			update_option('social_share_msg', $msg);
		}
	
		$value = get_option('social_share_link', '');
		$msg = get_option('social_share_msg', '');

		?>

		<h1>Modern Floating Social Share Settings</h1>

		<form method="POST">
			<label for="social_share_link">FLoating Social Share whatsapp Number Format : +Countrycode Number eg : +974 123123</label><br />
			<input type="text" name="social_share_link" id="social_share_link" value="<?php echo $value; ?>" placeholder="+974">
			<input type="text" name="social_share_msg" id="social_share_msg" value="<?php echo $msg; ?>" placeholder="Your Message">

			<input type="submit" value="Save" class="button button-primary button-large">
		</form>

		<?php
		echo '<div class="wrap">';
		echo '<p>This plugin is in very early stage. we will  update more functionalities to this.</p>';
		echo '</div>';
	}
}
