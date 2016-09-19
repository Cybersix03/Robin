<?php


require_once "models/User.php";
$users = new User("user");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Robin</title>
    </head>
    <body>
        <?php
        /*
            $rows = $users->findAll();
            var_dump($rows);
            foreach ($rows as $user){
                echo $user->id . " - ";
                echo $user->lname . " - ";
                echo $user->fname . " | ";
            }

            var_dump($users->find(1));*/

            $rows =json_encode($users->findAll());

            echo $rows . "<br />";

            var_dump(json_decode($rows));
        ?>
    </body>
</html>
