<?php

function editing_function_question($idquestion)
{
    include "SQL_table_connexion.php"; // Inclure le fichier
    $conn = connect(); // On se connecte à la base de données
    $sql = "SELECT * FROM `question` WHERE `AUTHOR` = '$_SESSION[PSEUDO]' ";
    $result = $conn->query($sql); 
    ?>
<form action="<?php $_PHP_SELF; ?>" method="post">

<input type="text" name="question" placeholder="taper ici votre modification">
<input type="submit" name="submit" value="Cliquez ici pour poster votre question" />
</form>
    <?php
    $content = NULL;
    if (isset($_POST['submit']))
    {
        $content = $_POST['question'];
    

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           
            if ($idquestion == $row["ID"]) {
                
                $sql2 = "UPDATE `question` SET `CONTENT` = '$content' WHERE `ID` = '$idquestion' ";
                $result2 = $conn->query($sql2);
                break;
            }
        }
    }
    }
return true;
}

function editing_function_answer($idreponse)
{
    include "SQL_table_connexion.php"; // Inclure le fichier
    $conn = connect(); // On se connecte à la base de données
    $sql = "SELECT * FROM `reponse` WHERE `AUTHOR` = '$_SESSION[PSEUDO]' ";
    $result = $conn->query($sql); 
    ?>
<form action="<?php $_PHP_SELF; ?>" method="post">

<input type="text" name="question" placeholder="taper ici votre modification">
<input type="submit" name="submit" value="Cliquez ici pour poster votre question" />
</form>
    <?php
    $content = NULL;
    if (isset($_POST['submit']))
    {
        $content = $_POST['question'];
    

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           
            if ($idreponse == $row["ID"]) {
                
                $sql2 = "UPDATE `reponse` SET `CONTENT` = '$content' WHERE `ID` = '$idreponse' ";
                $result2 = $conn->query($sql2);
                break;
            }
        }
    }
    }
return true;
}


?>