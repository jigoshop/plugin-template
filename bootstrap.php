<?php
#set( $LINKS = "${DS}links[]" )
/**
 * Plugin Name: ${PLUGIN_NAME}
 * Plugin URI:
 * Description:
 * Version: 1.0
 * Author: Jigoshop
 * Author URI: https://www.jigoshop.com/
 * Init File Version: 1.2
 * Init File Date: 10.03.2016
 */
// Define plugin name
define('JIGOSHOP_${CONST_NAME}_NAME', '${PLUGIN_NAME}');
add_action('plugins_loaded', function () {
    load_plugin_textdomain('plugin_textdomain', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    if (class_exists('\Jigoshop\Core')) {
        //Check version.
        if (\Jigoshop\addRequiredVersionNotice(JIGOSHOP_${CONST_NAME}_NAME, '2.0')) {
            return;
        }
        //Check license.
        ${DS}licence = new \Jigoshop\Licence(__FILE__, '${ID}', 'http://www.jigoshop.com');
        if (!${DS}licence->isActive()) {
            return;
        }
        // Define plugin directory for inclusions
        define('JIGOSHOP_${CONST_NAME}_DIR', dirname(__FILE__));
        // Define plugin URL for assets
        define('JIGOSHOP_${CONST_NAME}_URL', plugins_url('', __FILE__));
        //Init components.
        require_once(JIGOSHOP_${CONST_NAME}_DIR . '/src/Jigoshop/Extension/PluginName/common.php');
        if (is_admin()) {
            require_once(JIGOSHOP_${CONST_NAME}_DIR . '/src/Jigoshop/Extension/PluginName/backend.php');
        } else {
            require_once(JIGOSHOP_${CONST_NAME}_DIR . '/src/Jigoshop/Extension/PluginName/frontend.php');
        }
    } elseif (class_exists('jigoshop')) {
        //Check version.
        if (jigoshop_add_required_version_notice(JIGOSHOP_${CONST_NAME}_NAME, '1.17')) {
            return;
        }
        //Check license.
        ${DS}licence = new jigoshop_licence_validator(__FILE__, '${ID}', 'http://www.jigoshop.com');
        if (!${DS}licence->is_licence_active()) {
            return;
        }
        // Define plugin directory for inclusions
        define('JIGOSHOP_${CONST_NAME}_DIR', dirname(__FILE__) . '/Jigoshop1x');
        // Define plugin URL for assets
        define('JIGOSHOP_${CONST_NAME}_URL', plugins_url('', __FILE__) . '/Jigoshop1x');
        //Init components.
        require_once(JIGOSHOP_${CONST_NAME}_DIR . '/Jigoshop1x/src/to/plugin/common/code.php');
        if (is_admin()) {
            require_once(JIGOSHOP_${CONST_NAME}_DIR . '/Jigoshop1x/src/to/plugin/backend/code.php');
        } else {
            require_once(JIGOSHOP_${CONST_NAME}_DIR . '/Jigoshop1x/src/to/plugin/front/code.php');
        }
    } else {
        add_action('admin_notices', function () {
            echo '<div class="error"><p>';
            printf(__('%s requires Jigoshop plugin to be active. Code for plugin %s was not loaded.',
                'plugin_textdomain'), JIGOSHOP_${CONST_NAME}_NAME, JIGOSHOP_${CONST_NAME}_NAME);
            echo '</p></div>';
        });
    }
});
// this code need to be moved to the initial admin class
if (is_admin()) {
    add_filter('plugin_action_links_' . plugin_basename(__FILE__), function (${DS}links) {
        ${LINKS} = '<a href="https://www.jigoshop.com/documentation/plugin_name" target="_blank">Documentation</a>';
        ${LINKS} = '<a href="https://www.jigoshop.com/support/" target="_blank">Support</a>';
        ${LINKS} = '<a href="https://wordpress.org/support/view/plugin-reviews/jigoshop#postform" target="_blank">Rate Us</a>';
        ${LINKS} = '<a href="https://www.jigoshop.com/product-category/extensions/" target="_blank">More plugins for Jigoshop</a>';
        return ${DS}links;
    });
}