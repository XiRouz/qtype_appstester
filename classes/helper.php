<?php

/**
 * Helper class for AppsTester question type
 *
 * @package    qtype_appstester
 * @copyright  2023 Lavrentev Semyon
 */

namespace qtype_appstester;
defined('MOODLE_INTERNAL') || die();

/**
 * Helper class.
 *
 * @copyright  2023 Lavrentev Semyon
 */
class helper
{
    /** Get quiz object from DB by question attempt step ID
     * @param int $qas_id Question attempt step ID
     * @return \stdClass|false Quiz object from DB
     */
    public static function get_quiz_by_qas_id($qas_id) {
        global $DB;
        $sql = "
        SELECT quiz.*
        FROM {question_attempt_steps} qas
            JOIN {question_attempts} qa ON qa.id = qas.questionattemptid
            JOIN {question_usages} qu ON qu.id = qa.questionusageid
            JOIN {context} c ON c.id = qu.contextid
            JOIN {course_modules} cm ON cm.id = c.instanceid
            JOIN {quiz} quiz ON quiz.id = cm.instance
        WHERE qas.id = :qas_id
        ";
        $params = ['qas_id' => $qas_id];
        $result = $DB->get_record_sql($sql, $params);
        return $result;
    }

    /** Update a quiz. Mainly used to update grades after setting results on inactive quiz attempts.
     * @param \stdClass $quiz_cm The object of a quiz
     * @return void
     */
    public static function update_quiz_results($quiz_cm){
        \quiz_update_all_attempt_sumgrades($quiz_cm);
        \quiz_update_all_final_grades($quiz_cm);
        \quiz_update_grades($quiz_cm);
        mtrace("Updated grades for quiz \"" . $quiz_cm->name . "\".");
    }
}