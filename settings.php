<?php

/**
 * Configuration settings declaration information for the AppsTester question type.
 *
 * @package    qtype
 * @subpackage appstester
 * @copyright  2023 Lavrentev Semyon
 */

defined('MOODLE_INTERNAL') || die();

$settings->add(new admin_setting_heading(
    'appstester_settings',
    get_string('appstester_settings', 'qtype_appstester'),
    '')
);

$settings->add(new admin_setting_configcheckbox(
    "qtype_appstester/enable_notifications",
    get_string('enable_notifications', 'qtype_appstester'),
    get_string('enable_notifications_desc', 'qtype_appstester'),
    0)
);

$settings->add(new admin_setting_configtext(
    "qtype_appstester/max_check_duration_secs",
    get_string('max_check_duration_secs', 'qtype_appstester'),
    get_string('max_check_duration_secs_desc', 'qtype_appstester'),
    '300')
);

