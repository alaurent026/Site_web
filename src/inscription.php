<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>stack over eirb</title>
    <!--<link href='inscription.css' rel='stylesheet'>-->
</head>

<body>
    <header>
        <?php
        include "menu.php";
        ?>
    </header>

    <?php

    function checkEmail($email)
    {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false && $find2 > $find1);
    }

    function checkEmail_taken($email)
    {
        include "SQL_table_connexion.php"; // Inclure le fichier
        $conn = connect(); // On se connecte à la base de données
        $sql = "SELECT * FROM `users`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($email == $row["EMAIL"]) {
                    return false;
                }
            }
        }
        return true;
    }
    ?>




    <form id="register" action="<?php $_PHP_SELF; ?>" method="post">
        <input type="text" name="pseudo" placeholder="Nickname">
        <input type="password" name="motdepasse" placeholder="Password">
        <input type="text" name="email" placeholder="email">
        <input type="submit" name="submit" value ="BENVENITO">
    </form>



    <?php
    if (isset($_POST["submit"])) {
        include "SQL_table_connexion.php"; // Inclure le fichier
        $conn = connect(); // On se connecte à la base de données

        $pseudo = $_POST["pseudo"];
        $mdp = $_POST["motdepasse"];
        $email = $_POST["email"];

        if (($pseudo != NULL) && ($mdp != NULL) && ($email != NULL)) {
            if (checkEmail($email)) {
                if (checkEmail_taken($email) !== FALSE) {
                    $sql = "INSERT INTO `users` (`PSEUDO`,`MDP`,`EMAIL`)
                        VALUES ('$pseudo','$mdp','$email')";
                    $result = $conn->query($sql); // On lance la requête
                    if ($result === TRUE) {
                        header('Location: connexion.php');
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                } else {
                    echo "Votre email est déjà lié à un compte sur notre site, tentez de vous connectez à la place";
                }
            } else {
                echo "une vraie adresse mail plz";
            }
        } else {
            echo " Aucun champ ne peut être vide, completez s'il vous plaît";
        }
    }
    ?>

</body>

</html>