<?php
class Semester
{
    public $semesterCode;
    public $term;
    public $year;

    function __construct($semesterCode, $term, $year) {
        $this->semesterCode = $semesterCode;
        $this->term = $term;
        $this->year = $year;
    }
}
?>