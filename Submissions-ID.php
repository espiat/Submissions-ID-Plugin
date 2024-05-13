<?php

/**
 * @package Elementor Submissions ID in Email by der-spanier.de
 * @version 1.0.0
 */
/*
Plugin Name: Elementor Submissions ID in Email
Plugin URI: https://der-spanier.de
Description: Provides the submission ID as appendix AND Shortcode [get_submission_id] for email Template to the email sent by Elementor Pro forms.
Author: Marcus Spanier
Version: 1.1.0
Author URI: https://der-spanier.de
*/

/**
 * Class My_Elementor_Customizations
 *
 * This class provides customizations for Elementor Pro forms.
 */
class My_Elementor_Customizations
{
    /**
     * @var string The name of the submissions table.
     */
    private $submissions_table;

    /**
     * My_Elementor_Customizations constructor.
     *
     * Initializes the class by setting up hooks and properties.
     */
    public function __construct()
    {
        global $wpdb;
        $this->submissions_table = $wpdb->prefix . 'e_submissions';

        add_action('init', array($this, 'register_get_submission_id_shortcode'));
        add_filter('elementor_pro/forms/wp_mail_message', array($this, 'add_custom_text_to_email'), 10, 1);
    }

    /**
     * Registers the 'get_submission_id' shortcode.
     */
    public function register_get_submission_id_shortcode()
    {
        add_shortcode('get_submission_id', array($this, 'get_submission_id'));
    }

    /**
     * Retrieves the highest submission ID from the submissions table.
     *
     * @return int|string The highest submission ID or 'No results found' if no submissions exist.
     */
    public function get_submission_id()
    {
        global $wpdb;

        $sql    = "SELECT MAX(ID) as max_id FROM `{$this->submissions_table}`;";
        $result = $wpdb->get_var($sql);

        return $result ? (int) $result : 'No results found';
    }

    /**
     * Adds custom text to the email message.
     *
     * @param string $message The original email message.
     *
     * @return string The modified email message with the custom text appended.
     */
    public function add_custom_text_to_email($message)
    {
        $submission_id = $this->get_submission_id();

        $custom_text = "----------------------------- This is custom text added to the email.\n";
        $custom_text .= "Submission ID: " . $submission_id . "\n";

        return $message . $custom_text;
    }
}

// Instantiate the class
new My_Elementor_Customizations();