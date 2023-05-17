<?php

// GENERAL
$string['pluginname'] = 'Тест на реализацию приложения';
$string['pluginnameadding'] = 'Добавление теста на реализацию приложения';
$string['pluginnameediting'] = 'Редактирование теста на реализацию приложения';
$string['pluginnamesummary'] = 'Данный вопрос позволяет попросить ученика написать программу, которая при отправке решения будет автоматически проверена и оценена';
$string['android_template_zip_file'] = 'ZIP файл с шаблоном';
$string['android_submission_zip_file'] = 'ZIP файл с решением';
$string['check_options'] = 'Параметры проверки';
$string['checker_system_name'] = 'Сервис проверки';
$string['test_name'] = 'Название теста';
$string['test_result'] = 'Результат';
$string['html_result'] = '<p>Набрано {$a->grade} баллов из {$a-totalgrade}</p>';
$string['hideresult_whileactive'] = 'Скрывать результаты теста, пока попытка в прогрессе';
$string['hideresult_afterfinish'] = 'Скрывать результаты теста после завершения попытки';
$string['maxbytes'] = 'Максимальный размер файла решения студента';
$string['results_are_hidden'] = '[Результаты скрыты] ';
$string['no_files_submitted'] = 'Решение было отправлено на проверку без файла. Если это не так, попробуйте ещё раз или свяжитесь с администрацией.';
$string['same_response_submitted'] = 'Отправленное решение идентично предыдущему. Проверьте архив и попробуйте ещё раз.';
$string['app_is_tested'] = '<b>Приложение протестировано</b>';
$string['submission_is_in_queue'] = 'Ваше решение находится в очереди. Следите за статусом тестирования, обновляя страницу.';
$string['summarise_response'] = 'решение задачи';

// STATUSES
$string['android_checker:checking_started'] = 'Checking started';
$string['android_checker:unzip_files'] = 'Submission is extracting';
$string['android_checker:validate_submission'] = 'Checking if submission is valid';
$string['android_checker:gradle_build'] = 'Building application';
$string['android_checker:install_application'] = 'Installing application';
$string['android_checker:test'] = 'Testing application';
$string['android_checker:default'] = 'Checking status unknown';

// SETTINGS
$string['appstester_settings'] = 'Настройки AppsTester';
$string['enable_notifications'] = 'Включить уведомления';
$string['enable_notifications_desc'] = 'Включает возможность уведомить менеджера системы о проблемах с проверками. Для корректной работы 
помимо галочки необходимо дать роли "appstestermanager право "qtype/appstester:receivenotifications" и присвоить роль необходимым пользователям.';
$string['max_check_duration_secs'] = 'Максимально допустимая длительность проверки посылки в секундах';
$string['max_check_duration_secs_desc'] = 'Определяет временной порог тестирования посылок, 
после которого менеджерам системы тестирования отправляются уведомления о нарушении, если они включены.';

// CAPABILITIES
$string['appstester:receivenotifications'] = 'Получать оповещения о системе AppsTester';

// MESSAGES
$string['messageprovider:longsubmissionchecks'] = 'Предупреждение: Проверка посылок идёт слишком долго';

// TASKS
$string['task:update_quiz_grades'] = 'Обновить оценки за попытки тестов с вопросами AppsTester';
$string['task:check_submissions_duration'] = 'Проверка на длительность тестирования посылок';
