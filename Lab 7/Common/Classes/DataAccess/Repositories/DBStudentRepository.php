<?php
class DBStudentRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Student");
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
        return new Student($row[0], $row[1], $row[2], $row[3]);
    }

    function getAll() {
        $result = $this->dbManager->queryAll($this->tableName);
        return $this->parseQuery($result);
    }

    function getID($key) {
        $result = $this->dbManager->queryByFilter($this->tableName, "StudentId", $key);
        return $this->parseQuery($result);
    }

    // Return True of Success, False if failed
    function insert(Student $item) {
        $query = "INSERT INTO $this->tableName
                  VALUES('$item->studentID', '$item->name', '$item->phone', '$item->password')";
        return $this->dbManager->queryCustom($query);
    }

    // Return True of Success, False if failed
    function update(Student $item) {
        $query = "UPDATE $this->tableName
                  SET Name = '$item->name', Phone = '$item->phone', Password = '$item->password'
                  WHERE StudentId = '$item->studentID'";
        return $this->dbManager->queryCustom($query);
    }

    // Return True of Success, False if failed
    function delete(Student $item) {
        $query = "DELETE FROM $this->tableName
                  WHERE StudentId = '$item->studentID'";
        return $this->dbManager->queryCustom($query);
    }
}
?>