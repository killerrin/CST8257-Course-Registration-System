<?php
class Registration
{
    public $student;
    public $course;
    public $semester;

    function __construct(Student $student, Course $course, Semester $semester) {
        $this->student = $student;
        $this->course = $course;
        $this->semester = $semester;
    }
}
?>