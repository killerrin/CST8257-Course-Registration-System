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
            $tmpArray = array();
        	array_push($tmpArray, $row[0]); // CourseCode
        	array_push($tmpArray, $row[1]); // SemesterCode

            array_push($arrayResult, $tmpArray);
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

    function getByCourse($courseCode) {
        $query = "SELECT * FROM $this->tableName
                  WHERE
                    CourseCode = '$courseCode'";
        $result = $this->dbManager->queryCustom($query);
        return $this->parseQuery($result);
    }

    function getBySemester($semesterCode) {
        $query = "SELECT * FROM $this->tableName
                  WHERE
                    SemesterCode = '$semesterCode'";
        $result = $this->dbManager->queryCustom($query);
        return $this->parseQuery($result);
    }

    // Return True of Success, False if failed
    function insert(CourseOffer $item) {
        $courseCode = $item->course->courseCode;
        $semesterCode = $item->semester->semesterCode;
        $query = "INSERT INTO $this->tableName
                  (CourseCode, SemesterCode)
                  VALUES('$courseCode', '$semesterCode')";
        return $this->dbManager->queryCustom($query);
    }

    // Return True of Success, False if failed
    function delete(CourseOffer $item) {
        $courseCode = $item->course->courseCode;
        $semesterCode = $item->semester->semesterCode;
        $query = "DELETE FROM $this->tableName
                  WHERE
                    CourseCode = '$courseCode' AND
                    SemesterCode = '$semesterCode'";
        return $this->dbManager->queryCustom($query);
    }
}
?>