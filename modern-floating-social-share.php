<?php
/**
 * Modern Floating Social Share
 *
 * @package       MODERNFLOA
 * @author        Shebin KP
 * @license       gplv3-or-later
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Modern Floating Social Share
 * Plugin URI:    https://shebinkp7@gmail.com
 * Description:   Modern Designs for floating plugin
 * Version:       1.0.0
 * Author:        Shebin KP
 * Author URI:    https://shebinkp.co.in
 * Text Domain:   modern-floating-social-share
 * Domain Path:   /languages
 * License:       GPLv3 or later
 * License URI:   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Modern Floating Social Share. If not, see <https://www.gnu.org/licenses/gpl-3.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 * 
 * The comment above contains all information about the plugin 
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 * 
 * The function MODERNFLOA() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define( 'MODERNFLOA_NAME',			'Modern Floating Social Share' );

// Plugin version
define( 'MODERNFLOA_VERSION',		'1.0.0' );

// Plugin Root File
define( 'MODERNFLOA_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'MODERNFLOA_PLUGIN_BASE',	plugin_basename( MODERNFLOA_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'MODERNFLOA_PLUGIN_DIR',	plugin_dir_path( MODERNFLOA_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'MODERNFLOA_PLUGIN_URL',	plugin_dir_url( MODERNFLOA_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once MODERNFLOA_PLUGIN_DIR . 'core/class-modern-floating-social-share.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Shebin KP
 * @since   1.0.0
 * @return  object|Modern_Floating_Social_Share
 */
function MODERNFLOA() {
	return Modern_Floating_Social_Share::instance();
}

MODERNFLOA();
