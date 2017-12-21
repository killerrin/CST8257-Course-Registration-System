<?php
class DBCourseRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Course");
    }

    private function parseQuery($result) {
        $arrayResult = array();
        while ($row = mysqli_fetch_row($result))
        {
        	array_push($arrayResult, $this->rowToObject($row));
        }
        return $arrayResult;
    }
    private function rowToObject($row) {
        return new Course($row[0], $row[1], $row[2]);
    }

    function getAll() {
        $result = $this->dbManager->queryAll($this->tableName);
        return $this->parseQuery($result);
    }

    function getID($key) {
        $result = $this->dbManager->queryByFilter($this->tableName, "CourseCode", $key);
        return $this->parseQuery($result);
    }

    // Return True of Success, False if failed
    function insert(Course $item) {
        $query = "INSERT INTO $this->tableName
                  VALUES('$item->courseCode', '$item->title', $item->weeklyHours)";
        return $this->dbManager->queryCustom($query);
    }

    // Return True of Success, False if failed
    function update(Course $item) {
        $query = "UPDATE $this->tableName
                  SET Title = '$item->title', WeeklyHours = $item->weeklyHours
                  WHERE CourseCode = '$item->courseCode'";
        return $this->dbManager->queryCustom($query);
    }

    // Return True of Success, False if failed
    function delete(Course $item) {
        $query = "DELETE FROM $this->tableName
                  WHERE CourseCode = '$item->courseCode'";
        return $this->dbManager->queryCustom($query);
    }
}
?>