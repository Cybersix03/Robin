<?php // models/Users.php

require_once "Database.php";

class Model extends Database
{
    private $table;
    private $db;



    public function __construct($table)
    {
        $this->table = $table;
        $this->db = new Database();
    }

    // GETTERS
    public function get($attr) {
        return $this -> $attr;

    }
    //SETTER
    public function set($attr, $value) {
        return $this -> $attr = $value;
    }
    // Sélectionner tous les éléments
    public function findAll()
    {
        return $this->db->query("SELECT *
                                 FROM $this->table");
    }
    // Sélectionner un élément par son id
    public function find($id)
    {
        if ($id) {
            return $this->db->row("SELECT *
                                   FROM $this->table
                                   WHERE id = :id
                                   LIMIT 1",
                                   array("id" => $id));
        }
    }
    /**
     * Send to the bdd a request SELECT with the condition and the operator given in the parameters
     * @param  array    $conditions     a array containing the key of the champ and the value
     * @param  string   $operation      a string that indicate if we use AND or OR in the query
     * @return [object]     a object stdClass that containing the result of the query
     */
    public function findPrepare($conditions, $operation="AND")
    {
        $totalCount = count($conditions);
        $counter = 0;
        $statement = "SELECT * FROM $this->table WHERE ";

        foreach ($conditions as $key => $value) {
            if($counter == $totalCount-1){
                $statement.= $key . " = " . "'". $value. "'";
            }else{
                $statement.= $key . " = " . "'". $value. "' " .$operation . " ";
            }
            $counter++;
        }
        return $this->db->query($statement);
    }

    /**
     * Insert in the BDD all the elementes in the array given in the parameter
     * @param  array $arrayOf array of elements to insert in the bdd
     * @return boolean  return true
     */
    public function insert($arrayOf)
    {
        $nbrOf = count($arrayOf);
        for ($i = 0; $i <= $nbrOf-1; $i++) {

            $nbrOfArray = count($arrayOf[$i]);
            $counterKey = 0;
            $counterValue = 0;
            $statement = "INSERT INTO $this->table (";

            foreach ($arrayOf[$i] as $key => $value) {
                if($counterKey == $nbrOfArray-1){
                    $statement.= $key;
                }else{
                    $statement.= $key . ", ";
                }
                $counterKey++;
            }

            $statement.=") VALUES (";

            foreach ($arrayOf[$i] as $key => $value) {
                if($counterValue == $nbrOfArray-1){
                    $statement.= ":" . $key .")";
                }else{
                    $statement.= ":" . $key . ", ";
                }
                $counterValue++;
            }

            $this->db->prepare($statement, $arrayOf[$i]);
        }

        return true;
    }

    /**
     * Update the elements in function of the id of the element given in the parameter
     * @param  array $arrayOf array of elements
     * @return boolean return true
     */
    public function update($arrayOf)
    {
        $nbrOf = count($arrayOf);
        for ($i = 0; $i <= $nbrOf-1; $i++) {

            $nbrOfArray= count($arrayOf[$i]);
            $counterKey = 0;
            $statement = "UPDATE $this->table SET ";

            foreach($arrayOf[$i] as $key => $value){
                if($counterKey == $nbrOfArray-1){
                    $statement.= $key . " = :" . $key . " ";
                }else{
                    $statement.= $key . " = :" . $key . ", " ;
                }
                $counterKey++;
            }

            $statement.= "WHERE id = :id";

            $this->db->prepare($statement, $arrayOf[$i]);
        }

        return true;
    }
    /**
     * Delete the elements in function of the id of the element given in the parameter
     * @param  array $arrayOf array of elements or array of id of the elements
     * @return boolean return true
     */
    public function delete($arrayOf) {

        $nbrOf = count($arrayOf);
        $arrayOfId = [];
        for ($i = 0; $i <= $nbrOf-1; $i++) {

            $nbrOfArray= count($arrayOf[$i]);
            $statement = "DELETE FROM $this->table WHERE id = :id";

            foreach($arrayOf[$i] as $key => $value){
                if($key == "id"){
                    $arrayOfId = [
                        "id" => $value
                    ];
                }
            }

            $this->db->prepare($statement, $arrayOfId);
        }

        return true;
    }
}
