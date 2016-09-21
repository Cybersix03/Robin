<?php // models/Users.php

require_once "Model.php";
class User extends Model
{

    public function __construct($table)
    {
        parent::__construct($table);
    }
}
