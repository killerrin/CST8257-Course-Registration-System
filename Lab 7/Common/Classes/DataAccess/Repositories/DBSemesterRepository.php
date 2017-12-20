<?php
class DBSemesterRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Semester");
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }
}
?>