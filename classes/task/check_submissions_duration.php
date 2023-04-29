<?php

namespace qtype_appstester\task;

defined('MOODLE_INTERNAL') || die();

class check_submissions_duration extends \core\task\scheduled_task
{
    public function get_name()
    {
        return get_string('task:check_submissions_duration', 'qtype_appstester');
    }

    public function execute()
    {
        if (!get_config('qtype_appstester', 'enable_notifications')) {
            return;
        }
        global $CFG, $DB;

        // get submissions that have timestamp in '-_timesubmitted' - this means submission doesn't have a result yet
        $sql = "
            SELECT qa.id as attemptid, qas.id as attemptstepid, qasd.value as timesubmitted
            FROM {question_attempts} qa
            LEFT JOIN {question_attempt_steps} qas 
                ON qas.questionattemptid = qa.id
            LEFT JOIN {question_attempt_step_data} qasd 
				ON qasd.attemptstepid = qas.id 
				AND qasd.name = '-_timesubmitted'
            LEFT JOIN {question} q ON qa.questionid = q.id
            WHERE 
                q.qtype = 'appstester'
                AND qas.state = 'invalid'
                AND qasd.value IS NOT NULL
            GROUP BY qa.id, qas.id, qasd.value
        ";

        if (!($submissions = $DB->get_records_sql($sql))) {
            return;
        }

        $currenttime = time();
        $maxcheckduration = (int)get_config('qtype_appstester', 'max_check_duration_secs');

        // TODO: get_users_by_capability may be an expensive call, think of refactoring AT manager assignment and pull algorithm
        $managers = get_users_by_capability(\context_system::instance(), 'qtype/appstester:receivenotifications');
        if (empty($managers)) {
//            $managers = get_admin();
            return;
        }

        $slowchecks = array();

        foreach ($submissions as $sub) {
            if ((int)$sub->timesubmitted + $maxcheckduration <= $currenttime) {
                $slowchecks[] = $sub->attemptstepid;
            }
        }
        if (!empty($slowchecks)) {
            $slowchecks_str = "Slow submission checks detected, step IDs: " . implode(", ", $slowchecks);
            mtrace($slowchecks_str);
            $message = new \core\message\message();
            $message->component = 'qtype_appstester';
            $message->name = 'longsubmissionchecks';
            $message->userfrom = \core_user::get_noreply_user();
            $message->subject = 'Slow submission checks detected';
            $message->fullmessage = "{$slowchecks_str}";
            $message->fullmessageformat = FORMAT_MARKDOWN;
            $message->fullmessagehtml = "<p>html {$slowchecks_str}</p>";
            $message->smallmessage = 'small message';
            $message->notification = 1;
            $message->contexturl = (new \moodle_url(''))->out();
            $message->contexturlname = 'Course list';
//            $content = array('*' => array('header' => ' test ', 'footer' => ' test ')); // Extra content for specific processor
//            $message->set_additional_content('email', $content);
            foreach ($managers as $manager) {
                $message->userto = $manager;
                $messageid = message_send($message);
            }
        }
    }
}