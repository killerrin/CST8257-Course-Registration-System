<?php
class DBStudentRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Student");
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }
}
?>