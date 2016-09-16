<?php

require_once "models/Model.php";
$users = new Model("Users");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>test</title>
    </head>
    <body>

        <?php
            echo $users->get("table");?>
        <br />
        <?php
            $rows = $users->findAll();
            foreach ($rows as $user){
                echo $user->id . " - ";
                echo $user->prenom . " - ";
                echo $user->name . " | ";
            }
        ?>
        <br />
        <?php

            $user = $users->find(8);
            echo "<br />";
            echo $user['name'];
            echo "<br />";

            $champs = [
                "name" => "toto",
                "id" => "31",
            ];
            $row2 = $users->findPrepare($champs);
            foreach ($row2 as $user){
                echo $user->id . " - ";
                echo $user->prenom . " - ";
                echo $user->name . " | ";
            }

            echo "<br />";

            $t = [];
            $v = [
                "name" => "nonbidon",
                "prenom" => "ppp",
            ];
                        $d = [
                "name" => "dddd",
                "prenom" => "ppddddp",
            ];
                        $e = [
                "name" => "nonbeeeeidon",
                "prenom" => "peeepp",
            ];
            array_push($t, $v);
            array_push($t, $d);
            array_push($t, $e);

            //$users->insert($t);



            $update = [];
            $u = [
                "id" => '114',
            ];
            $p = [
                "id" => '9',
                "name" => "p",
                "prenom" => "pp",
            ];
            $d = [
                "id" => '10',
                "name" => "d",
                "prenom" => "dd",
            ];
            array_push($update, $u);
            array_push($update, $p);
            array_push($update, $d);

            //$users->update($update);

            $delete = [];

            array_push($delete, $u);


            $users->delete($update);

            $test = $users->findAll();
            foreach ($test   as $user){
                echo $user->id . " - ";
                echo $user->prenom . " - ";
                echo $user->name . " | ";
            }

        ?>
    </body>
</html>
