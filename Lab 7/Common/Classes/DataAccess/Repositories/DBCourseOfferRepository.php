<?php
class DBCourseOfferRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "CourseOffer");
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }
}
?>