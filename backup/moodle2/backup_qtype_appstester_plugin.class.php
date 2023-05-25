<?php

/**
 * @package    moodlecore
 * @subpackage backup-moodle2
 * @copyright  &copy; 2012 Richard Lobb
 * @author     Richard Lobb richard.lobb@canterbury.ac.nz
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/appstester/questiontype.php');

/**
 * Provides the information to backup AppsTester questions.
 */
class backup_qtype_appstester_plugin extends backup_qtype_plugin
{

    // Legacy code, for supporting a subclassing of coderunner.
    protected function qtype()
    {
        return 'appstester';
    }


    // Add the options to appstester question type structure.
    public function add_quest_coderunner_options($element)
    {
        $dummycoderunnerq = new qtype_coderunner();

        // Check $element is one nested_backup_element.
        if (!$element instanceof backup_nested_element) {
            throw new backup_step_exception("quest_coderunner_options_bad_parent_element", $element);
        }

        // Define the elements.
        $options = new backup_nested_element('coderunner_options');
        $optionfields = $dummycoderunnerq->extra_question_fields(); // It's not static :-(.
        array_shift($optionfields);
        $option = new backup_nested_element('coderunner_option', array('id'),
            $optionfields);

        // Build the tree.
        $element->add_child($options);
        $options->add_child($option);

        // Set the source.
        $option->set_source_table('question_coderunner_options', array('questionid' => backup::VAR_PARENTID));
    }


    // Add the testcases table to the coderunner question structure.
    private function add_quest_coderunner_testcases($element)
    {
        // Check $element is one nested_backup_element.
        global $DB;
        if (!$element instanceof backup_nested_element) {
            throw new backup_step_exception("quest_testcases_bad_parent_element", $element);
        }

        // Define the elements.
        $testcases = new backup_nested_element('coderunner_testcases');
        $testcase = new backup_nested_element('coderunner_testcase', array('id'), array(
            'testcode', 'testtype', 'expected', 'useasexample', 'display', 'hiderestiffail', 'mark', 'stdin', 'extra'));

        // Build the tree.
        $element->add_child($testcases);
        $testcases->add_child($testcase);

        // Set the source.
        $testcase->set_source_table("question_coderunner_tests", array('questionid' => backup::VAR_PARENTID), 'id ASC');
    }


    /**
     * Returns the qtype information to attach to question element.
     */
    protected function define_question_plugin_structure()
    {

        // Define the virtual plugin element with the condition to fulfill.
        $plugin = $this->get_plugin_element(null, '../../qtype', 'appstester');

        // Create one standard named plugin element (the visible container).
        $pluginwrapper = new backup_nested_element($this->get_recommended_name());

        // Connect the visible container ASAP.
        $plugin->add_child($pluginwrapper);

        // Now create the qtype own structures.
        $appstester = new backup_nested_element(
            'appstester',
            array('id'),
            array('checker_system_name', 'hideresult_whileactive', 'hideresult_afterfinish')
        );

        // Now the own qtype tree.
        $pluginwrapper->add_child($appstester);

        // Set source to populate the data.
        $appstester->set_source_table('qtype_appstester_parameters',
            array('questionid' => backup::VAR_PARENTID));

        return $plugin;
    }


    /**
     * Returns one array with filearea => mappingname elements for the qtype.
     *
     * Used by {@link get_components_and_fileareas} to know about all the qtype
     * files to be processed both in backup and restore.
     */
    public static function get_qtype_fileareas()
    {
        return array('template' => 'question_created');
    }
}
