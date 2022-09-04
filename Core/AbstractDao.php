<?php

// automatically instanciate the database when this class is called
namespace Core;
require_once ROOT . DIRECTORY_SEPARATOR .'Core' . DIRECTORY_SEPARATOR . 'Database.php';
abstract class AbstractDao
{
    protected  $dbh;
    public function __construct()
    {
        $this->dbh = Database::getInstance();
    }
}