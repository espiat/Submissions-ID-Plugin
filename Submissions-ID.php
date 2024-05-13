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

// Define a class for your functionality
class My_Elementor_Customizations
{

    // Constructor to initialize hooks
    public function __construct()
    {
        add_filter('elementor_pro/forms/wp_mail_message', array($this, 'add_custom_text_to_email'), 10, 3);
    }

    // Method to add custom text to the email
    public function add_custom_text_to_email($message)
    {
        // Modify $message as needed, adding your custom text
        $custom_text = "----------------------------- This is custom text added to the email.\n";

        // Append the custom text to the existing message
        $message .= $custom_text;

        // Return the modified message
        return $message;
    }
}

// Instantiate the class
new My_Elementor_Customizations();