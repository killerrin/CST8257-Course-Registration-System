<?php
class DBSemesterRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Semester");
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }

    function getID($key) {
        return $this->dbManager->queryByFilter($this->tableName, "SemesterCode", $key);
    }

    function insert(Semester $item) {
        $query = "INSERT INTO $this->tableName
                  VALUES('$item->semesterCode', '$item->term', $item->year)";
        return $this->dbManager->queryCustom($query);
    }

    function update(Semester $item) {
        $query = "UPDATE $this->tableName
                  SET Term = '$item->term', Year = $item->year
                  WHERE SemesterCode = '$item->semesterCode'";
        return $this->dbManager->queryCustom($query);
    }

    function delete(Semester $item) {
        $query = "DELETE FROM $this->tableName
                  WHERE SemesterCode = '$item->semesterCode'";
        return $this->dbManager->queryCustom($query);
    }
}
?>