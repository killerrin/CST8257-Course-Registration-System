<?php
class Course
{
    public $courseCode;
    public $title;
    public $weeklyHours;

    function __construct($courseCode, $title, $weeklyHours) {
        $this->courseCode = $courseCode;
        $this->title = $title;
        $this->weeklyHours = $weeklyHours;
    }
}
?>