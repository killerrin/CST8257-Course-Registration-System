<?php
class CourseOffer
{
    public $course;
    public $semester;

    function __construct(Course $course, Semester $semester) {
        $this->course = $course;
        $this->semester = $semester;
    }
}
?>