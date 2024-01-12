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
        include "vote_function.php";
        ?>
    </header>


    <article>
        <h2 id="questions">
            <?php

            $author =  $_SESSION['PSEUDO'];
            $idquestion = $_GET["idquestion"];
            $id_check = $_GET["idreponse"];
            $type = $_GET["type"];
            $conn = connect();
            $end = NULL;

            if (($id_check != 0) && ($type == 0)) {
                $sql6 = "SELECT * FROM `reponse` WHERE `ID` = '$id_check' ";
                $result6 = $conn->query($sql6);
                if ($result6->num_rows > 0) {
                    while ($row = $result6->fetch_assoc()) {
                        $end = $row['ID_QUESTION'];
                    }
                }
?><h2><?php vote_function_inc($id_check, $end);?></h2>
<?php
                        }
                        if (($id_check != 0) && ($type == 1)) {
                            $sql6 = "SELECT * FROM `reponse` WHERE `ID` = '$id_check' ";
                            $result6 = $conn->query($sql6);
                            if ($result6->num_rows > 0) {
                                while ($row = $result6->fetch_assoc()) {
                                    $end = $row['ID_QUESTION'];
                                }
                            }
?><h2><?php vote_function_dec($id_check, $end);?></h2>
<?php
                                        }

                                        $sql = "SELECT * FROM `question` WHERE `ID`='$idquestion'";
                                        $result1 = $conn->query($sql);
                                        $rowquestion = $result1->fetch_assoc();
?><h2>tu réponds à la question : <?php echo "$rowquestion[OBJECT] " ?></h2>

<?php
            echo "$rowquestion[CONTENT] ";

            $sql2 = " SELECT * FROM `reponse` ORDER BY `VOTE` DESC";

?>
            <h2>Réponses : </h2>
<?php

            $result = $conn->query($sql2);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $init = $row['VOTE'];
                    if ($row['ID_QUESTION'] == $idquestion) {

?><section id="forum">
    <?php
    ?><h3 id="auteur"><?php
            echo " $row[AUTHOR]"; 
    ?></h3><?php
    ?><h3 id="date"><?php
            echo "$row[DATE]";
    ?></h3><?php
            echo " $row[CONTENT]";
    ?><h3 id="vote"><?php 
            echo "likes : $row[VOTE]";
    ?></h3><?php
?>
            <button onclick="window.location.href='reponse.php?idquestion=<?php echo $idquestion ?>&idreponse=<?php echo $row['ID'] ?>&type=<?php echo 0 ?>';"> like </button>
            <button onclick="window.location.href='reponse.php?idquestion=<?php echo $idquestion ?>&idreponse=<?php echo $row['ID'] ?>&type=<?php echo 1 ?>';"> unlike </button>

                        </section>
<?php
                    }
                }
            } else {
?><h2>pas encore de réponses à cette question</h2>

<?php } ?>

            <form action="<?php $_PHP_SELF; ?>" method="post">
                <textarea id="corpsquestion" name="ans" cols="30" rows="10" placeholder="rédigez votre réponse"></textarea>
                <input id="subquestion" type="submit" name="submit3" value="publiez votre réponse ici">
            </form>


<?php

            if (isset($_POST["submit3"])) {
                echo "test";
                if ($_POST["ans"] != NULL) {
                    $answer = $_POST["ans"];
                    $date = date('d-m-y h:i:s');
                    $vote = 0;

                    $conn = connect(); // On se connecte à la base de données
                    $sql3 = "INSERT INTO `reponse` (`AUTHOR`,`ID_QUESTION`,`DATE`,`CONTENT`,`VOTE`)
                        VALUES ('$author','$idquestion','$date', '$answer', '$vote')";
                    $result = $conn->query($sql3); // On lance la requête

                    $sql4 = "SELECT * FROM `question` WHERE `ID`='$idquestion'";
                    $result2 = $conn->query($sql4);
                    $rowquestion2 = $result2->fetch_assoc();
                    $nb_rep = 1 + $rowquestion2['NB_REPONSE'];

                    $sql5 = "UPDATE `question` SET `NB_REPONSE` = '$nb_rep' WHERE `ID` = '$idquestion'";
                    $result = $conn->query($sql5);
                }
                header("Location:reponse.php?idquestion=$idquestion&type=-1&idreponse=0");
            }


?>
        </h2>
    </article>
</body>

</html>