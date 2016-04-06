#set( $LINKS = "${DS}links[]" )
#set( $TEXTDOMAIN = $CONSTANT.toLowerCase())
#set( $ESCAPER = "\")
#set( $DOC = $TEXTDOMAIN.replace("_","-"))
#set( $NAMESPACE_SUFFIX = ${StringUtils.removeAndHump($TEXTDOMAIN, "_")})
<?php

namespace Jigoshop\Extension$ESCAPER$NAMESPACE_SUFFIX;


class Admin
{
    public function __construct()
    {
        add_filter('plugin_action_links_' . plugin_basename(JIGOSHOP_${CONSTANT}_DIR . '/bootstrap.php'), array(${DS}this, 'actionLinks'));
        //DO NOT FORGET TO DELETE THIS!
        add_action('admin_notices', function () {
            echo '<div class="error"><p>';
            printf(__('%s -This plugin is not Jigoshop 2.0 compatible at the moment, please wait for it`s next update ',
                'jigoshop_${TEXTDOMAIN}'), JIGOSHOP_${CONSTANT}_NAME, JIGOSHOP_${CONSTANT}_NAME);
            echo '</p></div>';
        });
    }


    /**
     * Show action links on plugins page.
     *
     * @param ${DS}links
     *
     * @return array
     */
    public function actionLinks(${DS}links)
{


$LINKS = '<a href="https://www.jigoshop.com/documentation/$DOC" target="_blank">Documentation</a>';
$LINKS = '<a href="https://www.jigoshop.com/support/" target="_blank">Support</a>';
$LINKS = '<a href="https://wordpress.org/support/view/plugin-reviews/jigoshop#$postform" target="_blank">Rate Us</a>';
$LINKS = '<a href="https://www.jigoshop.com/product-category/extensions/" target="_blank">More plugins for Jigoshop</a>';
return ${DS}links;


    }

}