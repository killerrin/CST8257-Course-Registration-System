<?php
class DBCourseOfferRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "CourseOffer");
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }

    function getID($courseCode, $semesterCode) {
        $query = "SELECT * FROM $this->tableName
                  WHERE
                    CourseCode = '$courseCode' AND
                    SemesterCode = '$semesterCode'";
        return $this->dbManager->queryCustom($query);
    }

    function insert(CourseOffer $item) {
        $query = "INSERT INTO $this->tableName
                  (CourseCode, SemesterCode)
                  VALUES('$item->course->courseCode', '$item->semester->semesterCode')";
        return $this->dbManager->queryCustom($query);
    }

    function delete(CourseOffer $item) {
        $query = "DELETE FROM $this->tableName
                  WHERE
                    CourseCode = '$item->course->courseCode' AND
                    SemesterCode = '$item->semester->semesterCode'";
        return $this->dbManager->queryCustom($query);
    }
}
?>