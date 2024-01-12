<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>stack over eirb</title>

</head>

<body>
    <header>
        <?php
        include "menu.php";
        include "SQL_table_connexion.php";
        ?>
    </header>

    <form id="login" action="<?php $_PHP_SELF; ?>" method="post">
        <input type="text" name="pseudo" placeholder="Nickname or email"/>
        <input type="password" name="motdepasse" placeholder="Password"/>
        <input type="submit" name="submit" placeholder="Log in" value="ENTRADO ESTA ACQUIS">
    </form>

    <?php
    if (isset($_POST["submit"])) {

        $conn = connect(); // On se connecte à la base de données

        $pseudoconnexion = $_POST["pseudo"];
        $mdpconnexion = $_POST["motdepasse"];

        $sql = "SELECT * FROM `users`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                if ($pseudoconnexion == $row["PSEUDO"] && $mdpconnexion == $row["MDP"]) {
                    echo "connexion réussie";
                    // On définie les variables de session
                    $_SESSION["PSEUDO"] = "$pseudoconnexion";
                    echo ", bienvenu $_SESSION[PSEUDO]!";
                    header('Location: home.php');
                    break;
                } else if ($pseudoconnexion == $row["EMAIL"] && $mdpconnexion == $row["MDP"]) {
                    echo "connexion réussie";
                    // On définie les variables de session
                    $_SESSION["PSEUDO"] = "$pseudoconnexion";
                    echo ", bienvenu $_SESSION[PSEUDO]!";
                    break;
                }
                $_SESSION["PSEUDO"] = NULL;
            }
            if ($_SESSION['PSEUDO'] == NULL) {
                echo "echec de connexion, vérifiez mdp et autres champs svp";
            }
        }
    }

    ?>

</body>

</html>