<?php
class DBCourseRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Course");
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }

    function getID($key) {
        return $this->dbManager->queryByFilter($this->tableName, "CourseCode", $key);
    }

    function insert(Course $item) {
        $query = "INSERT INTO $this->tableName
                  VALUES('$item->courseCode', '$item->title', $item->weeklyHours)";
        return $this->dbManager->queryCustom($query);
    }

    function update(Course $item) {
        $query = "UPDATE $this->tableName
                  SET Title = '$item->title', WeeklyHours = $item->weeklyHours
                  WHERE CourseCode = '$item->courseCode'";
        return $this->dbManager->queryCustom($query);
    }

    function delete(Course $item) {
        $query = "DELETE FROM $this->tableName
                  WHERE CourseCode = '$item->courseCode'";
        return $this->dbManager->queryCustom($query);
    }
}
?>