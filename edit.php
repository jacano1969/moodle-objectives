<?php

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

$courseid = required_param('course',PARAM_INT);
$viewtab = optional_param('viewtab', 'objectives', PARAM_TEXT);
$weekstart = optional_param('weekstart', 0, PARAM_INT);

$course = $DB->get_record('course', array('id'=>$courseid));
if (!$course) {
    //UT
    error('Invalid courseid');
}

$url = new moodle_url('/blocks/objectives/edit.php',array('course'=>$course->id, 'viewtab'=>$viewtab));
if ($weekstart != 0) {
    $url->add_param('weekstart',$weekstart);
}
$PAGE->set_url($url);

require_login($course);

$obj = new block_objectives_class($course);

if ($viewtab == 'timetables') {
    $obj->edit_timetables();
} else {
    $obj->edit_objectives($weekstart);
}

?>