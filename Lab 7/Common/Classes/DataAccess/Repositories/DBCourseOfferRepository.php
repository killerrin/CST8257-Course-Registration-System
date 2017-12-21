<?php
class DBCourseOfferRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "CourseOffer");
    }

    private function parseQuery($result) {
        $arrayResult = array();
        while ($row = mysqli_fetch_row($result))
        {
        	array_push($arrayResult, $this->rowToObject($row[0]));
        	array_push($arrayResult, $this->rowToObject($row[1]));
        }
        return $arrayResult;
    }

    function getAll() {
        $result = $this->dbManager->queryAll($this->tableName);
        return $this->parseQuery($result);
    }

    function getID($courseCode, $semesterCode) {
        $query = "SELECT * FROM $this->tableName
                  WHERE
                    CourseCode = '$courseCode' AND
                    SemesterCode = '$semesterCode'";
        $result = $this->dbManager->queryCustom($query);
        return $this->parseQuery($result);
    }

    // Return True of Success, False if failed
    function insert(CourseOffer $item) {
        $query = "INSERT INTO $this->tableName
                  (CourseCode, SemesterCode)
                  VALUES('$item->course->courseCode', '$item->semester->semesterCode')";
        return $this->dbManager->queryCustom($query);
    }

    // Return True of Success, False if failed
    function delete(CourseOffer $item) {
        $query = "DELETE FROM $this->tableName
                  WHERE
                    CourseCode = '$item->course->courseCode' AND
                    SemesterCode = '$item->semester->semesterCode'";
        return $this->dbManager->queryCustom($query);
    }
}
?>