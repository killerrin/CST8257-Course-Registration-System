<?php
class DBSemesterRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Semester");
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
        return new Semester($row[0], $row[1], $row[2]);
    }

    function getAll() {
        $result = $this->dbManager->queryAll($this->tableName);
        return $this->parseQuery($result);
    }

    function getID($key) {
        $result = $this->dbManager->queryByFilter($this->tableName, "SemesterCode", $key);
        return $this->parseQuery($result);
    }

    // Return True of Success, False if failed
    function insert(Semester $item) {
        $query = "INSERT INTO $this->tableName
                  VALUES('$item->semesterCode', '$item->term', $item->year)";
        return $this->dbManager->queryCustom($query);
    }

    // Return True of Success, False if failed
    function update(Semester $item) {
        $query = "UPDATE $this->tableName
                  SET Term = '$item->term', Year = $item->year
                  WHERE SemesterCode = '$item->semesterCode'";
        return $this->dbManager->queryCustom($query);
    }

    // Return True of Success, False if failed
    function delete(Semester $item) {
        $query = "DELETE FROM $this->tableName
                  WHERE SemesterCode = '$item->semesterCode'";
        return $this->dbManager->queryCustom($query);
    }
}
?>