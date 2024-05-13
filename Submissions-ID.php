<?php

/**
 * @package Submissions ID by Schwarzer Falke e.V.
 * @version 1.0.0
 */
/*
Plugin Name: Submissions ID
Plugin URI: https://schwarzer-falke.org/
Description: Provides the submission ID for integration into HTML.
Author: Schwarzer Falke e.V. - Christian Geschwandtner
Version: 1.0.0
Author URI: https://schwarzer-falke.org/
*/

add_action('elementor_pro/forms/new_record', 'modify_elementor_email_content', 10, 2);
function modify_elementor_email_content($record, $handler)
{
    $email_content = $handler->get_settings('email_content');
    $email_content .= "\n\nAdditional text added by the plugin.";
    $handler->set_settings('email_content', $email_content);
}