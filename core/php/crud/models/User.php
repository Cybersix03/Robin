<?php // models/Users.php

require_once "models/Model.php";
class User extends Model
{

    public function __construct($table)
    {
        parent::__construct($table);
    }
}
