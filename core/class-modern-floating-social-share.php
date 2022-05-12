<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This is the main class that is responsible for registering
 * the core functions, including the files and setting up all features. 
 * 
 * To add a new class, here's what you need to do: 
 * 1. Add your new class within the following folder: core/includes/classes
 * 2. Create a new variable you want to assign the class to (as e.g. public $helpers)
 * 3. Assign the class within the instance() function ( as e.g. self::$instance->helpers = new Modern_Floating_Social_Share_Helpers();)
 * 4. Register the class you added to core/includes/classes within the includes() function
 * 
 * HELPER COMMENT END
 */

if ( ! class_exists( 'Modern_Floating_Social_Share' ) ) :

	/**
	 * Main Modern_Floating_Social_Share Class.
	 *
	 * @package		MODERNFLOA
	 * @subpackage	Classes/Modern_Floating_Social_Share
	 * @since		1.0.0
	 * @author		Shebin KP
	 */
	final class Modern_Floating_Social_Share {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Modern_Floating_Social_Share
		 */
		private static $instance;

		/**
		 * MODERNFLOA helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Modern_Floating_Social_Share_Helpers
		 */
		public $helpers;

		/**
		 * MODERNFLOA settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Modern_Floating_Social_Share_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'modern-floating-social-share' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'modern-floating-social-share' ), '1.0.0' );
		}

		/**
		 * Main Modern_Floating_Social_Share Instance.
		 *
		 * Insures that only one instance of Modern_Floating_Social_Share exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Modern_Floating_Social_Share	The one true Modern_Floating_Social_Share
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Modern_Floating_Social_Share ) ) {
				self::$instance					= new Modern_Floating_Social_Share;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Modern_Floating_Social_Share_Helpers();
				self::$instance->settings		= new Modern_Floating_Social_Share_Settings();

				//Fire the plugin logic
				new Modern_Floating_Social_Share_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'MODERNFLOA/plugin_loaded' );
			}

			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once MODERNFLOA_PLUGIN_DIR . 'core/includes/classes/class-modern-floating-social-share-helpers.php';
			require_once MODERNFLOA_PLUGIN_DIR . 'core/includes/classes/class-modern-floating-social-share-settings.php';

			require_once MODERNFLOA_PLUGIN_DIR . 'core/includes/classes/class-modern-floating-social-share-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'modern-floating-social-share', FALSE, dirname( plugin_basename( MODERNFLOA_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.