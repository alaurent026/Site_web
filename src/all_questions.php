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
        $sql = "SELECT * FROM `question` ORDER BY `ID` DESC";
        echo " Liste de toutes les questions posées sur notre beau site :  ";
        $conn = connect();
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?><section id="forum"><?php
                                    echo " $row[CONTENT] ";
                                    ?>
                    <button onclick="window.location.href='reponse.php?idquestion=<?php echo $row['ID'] ?>&idreponse=<?php echo 0 ?>&type=<?php echo -1 ?>';"> Répondre à cette question </button>

            <?php
            }
        }

            ?>
                </section>

    </h2>
    </article>
</body>

</html>