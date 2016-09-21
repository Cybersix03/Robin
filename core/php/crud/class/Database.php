<?php
class Database
{
    private $pdo = null;

    public function __construct()
    {
        $this->db_name = "Robin";
        $this->db_user = "root";
        $this->db_pass = "root";
        $this->db_host = "localhost";
        $this->db_port = 8889 ;
    }

    // BDD connexion
    private function getPDO()
    {
        if ($this->pdo === null) {

            try {
                // DSN
                $pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";port=". DB_PORT, DB_USER, DB_PASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec("SET CHARACTER SET utf8");

                $this->pdo = $pdo;

            } catch (PDOException $e) {
                echo 'Pas de connexion avec la BDD : ' . $e->getMessage();
                die();
            }

        }

        return $this->pdo;
    }
    // simple requeste
    public function query($statement)
    {
        $req  = $this->getPDO()->query($statement);
        $data = $req->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    // prepare requeste
    public function prepare($statement, $attributes = array())
    {
        $query  = explode(" ", $statement);
        // Récupération du 1èr mot
        $option = strtolower(array_shift($query));

        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);

        if ($option == "select" || $option == "show") {

            if ($req->rowCount() > 0) {
                $data = $req->fetchAll(PDO::FETCH_CLASS);
                return $data;
            }

        } elseif ($option == "insert" || $option == "update" || $option == "delete") {

            if ($option == "insert") {
                // Valeur id inséré
                return $this->getPDO()->lastInsertId();
            } else {
                return $req->rowCount();
            }

        }
    }

    // one row
    public function row($statement, $attributes = array())
    {
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);
        $data = $req->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
}
