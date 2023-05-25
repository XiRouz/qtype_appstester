<?php

// GENERAL
$string['pluginname'] = 'Application\'s implementation test';
$string['pluginnameadding'] = 'Adding of application\'s implementation test';
$string['pluginnameediting'] = 'Editing of application\'s implementation test';
$string['pluginnamesummary'] = '';
$string['android_template_zip_file'] = 'ZIP file with template';
$string['android_submission_zip_file'] = 'ZIP file with submission';
$string['check_options'] = 'Checker parameters';
$string['checker_system_name'] = 'Checker service';
$string['test_name'] = 'Test name';
$string['test_result'] = 'Result';
$string['html_result'] = '<p>You got {$a->grade} points out of {$a->totalgrade}</p>';
$string['hideresult_whileactive'] = 'Hide results while test attempt is active';
$string['hideresult_afterfinish'] = 'Hide results after test attempt is finished';
$string['maxbytes'] = 'Maximum student\'s submission file size';
$string['results_are_hidden'] = '[Results are hidden] ';
$string['no_files_submitted'] = 'It looks like you submitted a response without any files, if that is not true, try again or contact administrators.';
$string['same_response_submitted'] = 'It looks like your submitted response is identical with your previous response, check your files and try again.';
$string['app_is_tested'] = '<b>App is tested</b>';
$string['submission_is_in_queue'] = 'Your submission is in queue. Monitor the progress of testing by updating the page.';
$string['summarise_response'] = 'task\'s solution';

// STATUSES
$string['android_checker:checking_started'] = 'Checking started';
$string['android_checker:unzip_files'] = 'Submission is extracting';
$string['android_checker:validate_submission'] = 'Checking if submission is valid';
$string['android_checker:gradle_build'] = 'Building application';
$string['android_checker:install_application'] = 'Installing application';
$string['android_checker:test'] = 'Testing application';
$string['android_checker:default'] = 'Checking status unknown';

// SETTINGS
$string['appstester_settings'] = 'AppsTester settings';
$string['enable_notifications'] = 'Enable notifications';
$string['enable_notifications_desc'] = 'Enables notifications for manager of AppsTester system. For this to work you also need to 
give "qtype/appstester:receivenotifications" capability to "appstestermanager" role and give that role to  the right people.';
$string['max_check_duration_secs'] = 'Max check duration in seconds';
$string['max_check_duration_secs_desc'] = 'Defines how much time is allowed to pass before Moodle starts sending notifications to AppsTester system\'s managers';

// CAPABILITIES
$string['appstester:receivenotifications'] = 'Receive notifications about AppsTester system';

// MESSAGES
$string['messageprovider:longsubmissionchecks'] = 'Alert: Checking of submission(s) is too long';

// TASKS
$string['task:update_quiz_grades'] = 'Update grades for quiz attempts with AppsTester questions';
$string['task:check_submissions_duration'] = 'Check submissions testing duration';
