<?php

#set( $TEXTDOMAIN = $CONST_NAME.toLowerCase())
#set( $PLUGIN_PATH = ${StringUtils.removeAndHump($TEXTDOMAIN, "_")})

/**
 * Plugin Name: ${PLUGIN_NAME}
 * Plugin URI:
 * Description:
 * Version: 1.0
 * Author: Jigoshop
 * Author URI: https://www.jigoshop.com/
 * Init File Version: 1.3
 * Init File Date: 01.04.2016
 */
// Define plugin name
define('JIGOSHOP_${CONST_NAME}_NAME', '${PLUGIN_NAME}');
add_action('plugins_loaded', function () {
    load_plugin_textdomain('jigoshop_$TEXTDOMAIN', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    if (class_exists('\Jigoshop\Core')) {
        //Check version.
        //if (\Jigoshop\addRequiredVersionNotice(JIGOSHOP_${CONST_NAME}_NAME, '2.0')) {
        //    return;
        //}
        //Check license.
        //${DS}licence = new \Jigoshop\Licence(__FILE__, '${ID}', 'http://www.jigoshop.com');
        //if (!${DS}licence->isActive()) {
        //   return;
        //}
        // Define plugin directory for inclusions
        define('JIGOSHOP_${CONST_NAME}_DIR', dirname(__FILE__));
        // Define plugin URL for assets
        define('JIGOSHOP_${CONST_NAME}_URL', plugins_url('', __FILE__));
        //Init components.
        //require_once(JIGOSHOP_${CONST_NAME}_DIR . '/src/Jigoshop/Extension/$PLUGIN_PATH/Common.php');
        if (is_admin()) {
            require_once(JIGOSHOP_${CONST_NAME}_DIR . '/src/Jigoshop/Extension/$PLUGIN_PATH/Admin.php');
        } //else {
        //require_once(JIGOSHOP_${CONST_NAME}_DIR . '/src/Jigoshop/Extension/$PLUGIN_PATH/Frontend.php');
        //}
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
        require_once(JIGOSHOP_${CONST_NAME}_DIR . '/src/to/old/plugin/start/file.php');
    } else {
        add_action('admin_notices', function () {
            echo '<div class="error"><p>';
            printf(__('%s requires Jigoshop plugin to be active. Code for plugin %s was not loaded.',
                'jigoshop_$TEXTDOMAIN'), JIGOSHOP_${CONST_NAME}_NAME, JIGOSHOP_${CONST_NAME}_NAME);
            echo '</p></div>';
        });
    }
});
