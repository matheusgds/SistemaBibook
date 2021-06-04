<?php

class Conexao {

    public function Conn() {
       
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "testephp";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            return false;
        } else {
            return $conn;
        }
    }

}

?>