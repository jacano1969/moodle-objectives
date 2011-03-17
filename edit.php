<?php

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

$courseid = required_param('course',PARAM_INT);
$viewtab = optional_param('viewtab', 'objectives', PARAM_TEXT);

$course = get_record('course', 'id', $courseid);
if (!$course) {
    error('Invalid courseid');
}

require_login($course);

$obj = new block_objectives_class($course);

if ($viewtab == 'timetables') {
    $obj->edit_timetables();
} else {
    $obj->edit_objectives();
}

?>