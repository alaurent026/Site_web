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
        include "editing.php";
        ?>

    </header>

    <h2 id="questions">

        <?php

        $editing = $_GET["editing"];
        $idquestion = $_GET["idquestion"];
        $idreponse = $_GET["idreponse"];

        if (($editing == 1) && ($idreponse == 0)) {
            editing_function_question($idquestion);
        } else if (($editing == 1) && ($idquestion == 0)) {
            editing_function_answer($idreponse);
        }

        $sql = "SELECT * FROM `question` WHERE `AUTHOR` = '$_SESSION[PSEUDO]' ";
        ?>Vos questions messire<?php echo " $_SESSION[PSEUDO] :"; ?>

        <?php

        $conn = connect();

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?><section id="forum"><?php

                                                echo " $row[CONTENT]";
                                                ?>
                    <button onclick="window.location.href='user_profile.php?editing=<?php echo 1 ?>&idquestion=<?php echo $row['ID'] ?>&idreponse=<?php echo 0 ?>';"> Edit this question </button>

            <?php
            }
        } else {
            echo " pas encore de questions de votre part messire";
        }

            ?>
                </section>
    </h2>

    <h2 id="questions">
        <?php

        $sql2 = "SELECT * FROM `reponse` WHERE `AUTHOR` = '$_SESSION[PSEUDO]' ";
        ?>Vos réponses messire<?php echo " $_SESSION[PSEUDO] :"; ?>

        <?php

        $conn = connect();

        $result = $conn->query($sql2);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?><section id="forum"><?php

                                                echo " $row[CONTENT] | ";
                                                ?>
                    <button onclick="window.location.href='user_profile.php?editing=<?php echo 1 ?>&idreponse=<?php echo $row['ID'] ?>&idquestion=<?php echo 0 ?>';"> Editer cette réponse </button>

            <?php
            }
        } else {
            ?><h2>pas encore de réponses de votre part messire</h2><?php
        }



            ?>
                </section>
    </h2>

</body>

</html>