<?php
        function connect() {
            $servername = "localhost";
            $username = "alaurent026";
            $password = "feta01ca";
            $dbname = "alaurent026";
     
            // On crée notre connexion
            $conn = new mysqli($servername, $username, $password, $dbname);
            // On vérifie si elle a bien fonctionnée
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            return $conn;
        }
?>