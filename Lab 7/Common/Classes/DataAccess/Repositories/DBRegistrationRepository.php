<?php
class DBRegistrationRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Registration");
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }

    function getID($studentID, $courseCode, $semesterCode) {
        $query = "SELECT * FROM $this->tableName
                  WHERE
                    StudentId = '$studentID' AND
                    CourseCode = '$courseCode' AND
                    SemesterCode = '$semesterCode'";
        return $this->dbManager->queryCustom($query);
    }

    function insert(Registration $item) {
        $query = "INSERT INTO $this->tableName
                  (StudentId, CourseCode, SemesterCode)
                  VALUES('$item->student->studentID', '$item->course->courseCode', '$item->semester->semesterCode')";
        return $this->dbManager->queryCustom($query);
    }

    function delete(Registration $item) {
        $query = "DELETE FROM $this->tableName
                  WHERE
                    StudentId = '$item->student->studentID' AND
                    CourseCode = '$item->course->courseCode' AND
                    SemesterCode = '$item->semester->semesterCode'";
        return $this->dbManager->queryCustom($query);
    }
}
?>