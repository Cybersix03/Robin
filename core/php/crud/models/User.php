<?php

require_once "../config/config.php";
require_once "../class/User.php";
$users = new User("user");
$rows =json_encode($users->findAll());
echo $rows
?>

