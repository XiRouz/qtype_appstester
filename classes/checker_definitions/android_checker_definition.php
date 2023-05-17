<?php

namespace qtype_appstester\checker_definitions;

use html_table;
use html_writer;

use qtype_appstester\checker_definitions\parameters\single_file_parameter;
use qtype_appstester\checker_definitions\parameters\string_parameter;

class android_checker_definition implements checker_definition
{

    public function get_system_name(): string
    {
        return 'android';
    }

    public function get_human_readable_name(): string
    {
        return 'Android';
    }

    public function get_teacher_parameters(): array
    {
        return array(
            new single_file_parameter('template', get_string('android_template_zip_file', 'qtype_appstester'), array('zip')),
        );
    }

    public function get_student_parameters(): array
    {
        return array(
            new single_file_parameter('submission', get_string('android_submission_zip_file', 'qtype_appstester'), array('zip'))
        );
    }

    public function render_result_feedback(array $result): string
    {
        if ($result["CompilationError"]) {
            return "<pre><code class='language-gradle'>" . $result["CompilationError"] . "</code></pre>";
        }

        if ($result["ValidationError"]) {
            return "<pre>" . $result["ValidationError"] . "</pre>";
        }

        $html = get_string('html_result', 'qtype_appstester',
            ['grade' => $result['Grade'], 'totalgrade' => $result['TotalGrade'] ]);

        $table = new html_table();
        $table->attributes = array(
            'style' => 'display: inline-block; overflow: auto; max-height: 60vh;'
        );
        $table->head = array(
            get_string('test_name', 'qtype_appstester'),
            get_string('test_result', 'qtype_appstester')
        );

        $test_results = [];
        foreach ($result['TestResults'] as $test_result) {
            $test_results[] = array($test_result['Test'], '<pre><code class="language-java">' . ($test_result['ResultCode'] === 0 ? 'OK' : $test_result['Stream']) . '</code></pre>');
        }

        $table->data = $test_results;

        $html .= html_writer::table($table);

        return $html;
    }

    /**
     * @throws \coding_exception
     */
    public function render_status_feedback(array $status): string
    {
        switch ($status['Status']) {
            case 'checking_started':
                return get_string('android_checker:checking_started', 'qtype_appstester');
            case 'unzip_files':
                return get_string('android_checker:unzip_files', 'qtype_appstester');
            case 'validate_submission':
                return get_string('android_checker:validate_submission', 'qtype_appstester');
            case 'gradle_build':
                return get_string('android_checker:gradle_build', 'qtype_appstester');
            case 'install_application':
                return get_string('android_checker:install_application', 'qtype_appstester');
            case 'test':
                return get_string('android_checker:test', 'qtype_appstester');
            default:
                return get_string('android_checker:default', 'qtype_appstester');
        }
    }

    public function get_fraction_from_result(array $result): float
    {
        $grade = $result['Grade'] ?? null;
        $total_grade = $result['TotalGrade'] ?? null;

        if (!$total_grade || !$grade) {
            return 0;
        }

        return $grade / $total_grade;
    }
}