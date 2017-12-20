<?php
class DBCourseRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Course");
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }
}
?>