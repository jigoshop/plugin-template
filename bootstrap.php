<?php
/**
 * Plugin Name:
 * Plugin URI:
 * Description:
 * Version: 1.0
 * Author: Jigoshop
 * Author URI: https://www.jigoshop.com/
 * Init File Version: 1.1
 * Init File Date: 08.03.2016
 */

// Define plugin URL for assets
if (!defined('JIGOSHOP_PLUGIN_NAME_URL')) {
    define('JIGOSHOP_PLUGIN_NAME_URL', plugins_url('', __FILE__));
}
// Define plugin name
if (!defined('JIGOSHOP_PLUGIN_NAME_NAME')) {
    define('JIGOSHOP_PLUGIN_NAME_NAME', 'Plugin Name');
}

add_action('plugins_loaded', function () {
    load_plugin_textdomain('plugin_textdomain', false, dirname(plugin_basename(__FILE__)) . '/languages/');

    if (class_exists('\Jigoshop\Core')) {
        //Check version.
        if (\Jigoshop\addRequiredVersionNotice(JIGOSHOP_PLUGIN_NAME_NAME, '2.0')) {
            return;
        }

        //Check license.
        $licence = new \Jigoshop\Licence(__FILE__, '13190', 'http://www.jigoshop.com');
        if (!$licence->isActive()) {
            return;
        }

        // Define plugin directory for inclusions
        if (!defined('JIGOSHOP_PLUGIN_NAME_DIR')) {
            define('JIGOSHOP_PLUGIN_NAME_DIR', dirname(__FILE__));
        }

        //Init components.
        require_once(JIGOSHOP_PLUGIN_NAME_DIR . '/src/PluginName.common.php');
        if (is_admin()) {
            require_once(JIGOSHOP_PLUGIN_NAME_DIR . '/src/PluginName.backend.php');
        } else {
            require_once(JIGOSHOP_PLUGIN_NAME_DIR . '/src/PluginName.frontend.php');
        }

    } elseif (class_exists('jigoshop')) {
        //Check version.
        if (jigoshop_add_required_version_notice(JIGOSHOP_PLUGIN_NAME_NAME, '1.17')) {
            return;
        }

        //Check license.
        $licence = new jigoshop_licence_validator(__FILE__, '13190', 'http://www.jigoshop.com');
        if (!$licence->is_licence_active()) {
            return;
        }

        // Define plugin directory for inclusions
        if (!defined('JIGOSHOP_PLUGIN_NAME_DIR')) {
            define('JIGOSHOP_PLUGIN_NAME_DIR', dirname(__FILE__) . '/Jigoshop1x');
        }

        //Init components.
        require_once(JIGOSHOP_PLUGIN_NAME_DIR . '/src/to/plugin/common/code.php');
        if (is_admin()) {
            require_once(JIGOSHOP_PLUGIN_NAME_DIR . '/src/to/plugin/backend/code.php');
        } else {
            require_once(JIGOSHOP_PLUGIN_NAME_DIR . '/src/to/plugin/front/code.php');
        }

    } else {
        add_action('admin_notices', function () {
            echo '<div class="error"><p>';
            printf(__('%s requires Jigoshop plugin to be active. Code for plugin %s was not loaded.',
                'plugin_textdomain'), JIGOSHOP_PLUGIN_NAME_NAME);
            echo '</p></div>';
        });
    }
});

// this code need to be moved to the initial admin class
if (is_admin()) {
    add_filter('plugin_action_links_' . plugin_basename(__FILE__), function ($links) {
        $links[] = '<a href="https://www.jigoshop.com/documentation/plugin_name" target="_blank">Documentation</a>';
        $links[] = '<a href="https://www.jigoshop.com/support/" target="_blank">Support</a>';
        $links[] = '<a href="https://wordpress.org/support/view/plugin-reviews/jigoshop#postform" target="_blank">Rate Us</a>';
        $links[] = '<a href="https://www.jigoshop.com/product-category/extensions/" target="_blank">More plugins for Jigoshop</a>';

        return $links;
    });
}