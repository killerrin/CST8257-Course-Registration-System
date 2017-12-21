<?php
class DBRegistrationRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Registration");
    }

    private function parseQuery($result) {
        $arrayResult = array();
        while ($row = mysqli_fetch_row($result))
        {
            $tmpArray = array();
        	array_push($tmpArray, $row[0]); // StudentId
        	array_push($tmpArray, $row[1]); // CourseCode
        	array_push($tmpArray, $row[2]); // SemesterCode

            array_push($arrayResult, $tmpArray);
        }
        return $arrayResult;
    }

    function getAll() {
        $result = $this->dbManager->queryAll($this->tableName);
        return $this->parseQuery($result);
    }

    function getID($studentID, $courseCode, $semesterCode) {
        $query = "SELECT * FROM $this->tableName
                  WHERE
                    StudentId = '$studentID' AND
                    CourseCode = '$courseCode' AND
                    SemesterCode = '$semesterCode'";
        $result = $this->dbManager->queryCustom($query);
        return $this->parseQuery($result);
    }

    function getForUser($studentID) {
        $query = "SELECT * FROM $this->tableName
                  WHERE
                    StudentId = '$studentID'";
        $result = $this->dbManager->queryCustom($query);
        return $this->parseQuery($result);
    }

    function getForUserOrdered($studentID, $orderValue, $orderCode) {
        $query = "SELECT * FROM $this->tableName
                  WHERE
                    StudentId = '$studentID'
                  ORDER BY $orderValue $orderCode";
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
    function insert(Registration $item) {
        $studentID = $item->student->studentID;
        $courseCode = $item->course->courseCode;
        $semesterCode = $item->semester->semesterCode;
        $query = "INSERT INTO $this->tableName
                  (StudentId, CourseCode, SemesterCode)
                  VALUES('$studentID', '$courseCode', '$semesterCode')";
        return $this->dbManager->queryCustom($query);
    }

    // Return True of Success, False if failed
    function delete(Registration $item) {
        $studentID = $item->student->studentID;
        $courseCode = $item->course->courseCode;
        $semesterCode = $item->semester->semesterCode;
        $query = "DELETE FROM $this->tableName
                  WHERE
                    StudentId = '$studentID' AND
                    CourseCode = '$courseCode' AND
                    SemesterCode = '$semesterCode'";
        return $this->dbManager->queryCustom($query);
    }
}
?>