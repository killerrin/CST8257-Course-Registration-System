<?php
class DBStudentRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Student");
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }

    function getID($key) {
        return $this->dbManager->queryByFilter($this->tableName, "StudentId", $key);
    }

    function insert(Student $item) {
        $query = "INSERT INTO $this->tableName
                  VALUES('$item->studentID', '$item->name', '$item->phone', '$item->password')";
        return $this->dbManager->queryCustom($query);
    }

    function update(Student $item) {
        $query = "UPDATE $this->tableName
                  SET Name = '$item->name', Phone = '$item->phone', Password = '$item->password'
                  WHERE StudentId = '$item->studentID'";
        return $this->dbManager->queryCustom($query);
    }

    function delete(Student $item) {
        $query = "DELETE FROM $this->tableName
                  WHERE StudentId = '$item->studentID'";
        return $this->dbManager->queryCustom($query);
    }
}
?>