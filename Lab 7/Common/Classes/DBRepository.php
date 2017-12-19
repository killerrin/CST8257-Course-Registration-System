<?php
class DBRepository
{
    public $dbManager;
    public $tableName;

    function __construct(DBManager $dbManager, $tableName) {
        $this->dbManager = $dbManager;
        $this->tableName = $tableName;
    }

    function getAll() {
        return $this->dbManager->queryAll($this->tableName);
    }
}
?>