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

function get_elementor_form_submission_id($form_id)
{
    if (class_exists('\ElementorPro\Modules\Forms\Module')) {
        $form_submissions = \ElementorPro\Modules\Forms\Module::instance()->get_submissions($form_id);
        if (!empty($form_submissions)) {
            $latest_submission = end($form_submissions);
            $submission_id = $latest_submission->get_id();
            return $submission_id;
        }
    }
    return '';
}

// Hook into the elementor_pro/forms/new_record action to get the submission ID
add_action('elementor_pro/forms/new_record', 'append_submission_id_to_email', 10, 2);
function append_submission_id_to_email($record, $ajax_handler)
{
    $form_id = $record->get_form_settings('id');
    $submission_id = get_elementor_form_submission_id($form_id);
    if (!empty($submission_id)) {
        $email_content = $record->get('email_content');
        $email_content .= "\n\nSubmission ID: " . $submission_id;
        $record->set('email_content', $email_content);
    }
}
