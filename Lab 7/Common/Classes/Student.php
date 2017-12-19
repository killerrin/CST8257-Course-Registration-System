<?php
class Student
{
    public $studentID;
    public $name;
    public $phone;
    public $password;

    function __construct($studentID, $name, $phone, $password) {
        $this->studentID = $studentID;
        $this->name = $name;
        $this->phone = $phone;
        $this->password = $password;
    }
}
?>