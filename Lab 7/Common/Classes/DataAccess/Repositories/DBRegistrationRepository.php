<?php
class DBRegistrationRepository extends DBGenericRepository
{
    function __construct(DBManager $dbManager) {
        parent::__construct($dbManager, "Registration");
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }
}
?>