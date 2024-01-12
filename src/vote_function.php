<?php
function vote_function_inc($id,$id_question)
{
    $compteur = 0;
    include "SQL_table_connexion.php"; // Inclure le fichier
    $conn = connect(); // On se connecte à la base de données
    $sql = "SELECT * FROM `reponse`";
    $result = $conn->query($sql);
    $author = $_SESSION["PSEUDO"];
    $bool = 1;
    
    $check = NULL;
    $check2 = NULL;
    $nb_vote = NULL;
    $sql3 = "SELECT * FROM `vote` WHERE `AUTHOR` = '$_SESSION[PSEUDO]' AND `ID_QUESTION` = '$id_question' ";
    $result3 = $conn->query($sql3);
    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) 
        {
            $check = $row['BOOL'];
            $check2 = $row['ID_REPONSE'];
        }
    }
    

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
                if ($id == $row["ID"]) {
                    if ($_SESSION["PSEUDO"] != $row["AUTHOR"])
                    {
                        if ( ($check== 0))
                        {
                            $sql6 = "SELECT * FROM `reponse` WHERE `ID` = '$id' ";
                            $result6 = $conn->query($sql6);
                            if ($result6->num_rows > 0) 
                            {
                                while ($row = $result6->fetch_assoc()) 
                                {
                                    $nb_vote = $row['VOTE'] + 1;                               
                                }
                            }
                        
                        $sql2 = "UPDATE `reponse` SET `VOTE` = $nb_vote WHERE `ID` = '$id' ";
                        $result2 = $conn->query($sql2);

                        $sql4 = "INSERT INTO `vote` (`AUTHOR`,`ID_QUESTION`,`BOOL`,`ID_REPONSE`)
                            VALUES ('$author','$id_question','1','$id')";

                        $result4 = $conn->query($sql4);
                        }
                        
                        else if ($check == -1)
                        {
                            
                            if ( $check2 != $id)   
                            {   
                            
                                $sql6 = "SELECT * FROM `reponse` WHERE `ID` = '$check2' ";
                                $result6 = $conn->query($sql6);
                                if ($result6->num_rows > 0) 
                                {
                                    while ($row = $result6->fetch_assoc()) 
                                    {
                                        $nb_vote = $row['VOTE'] + 1;                               
                                    }
                                }

                                $sql7 = "SELECT * FROM `reponse` WHERE `ID` = '$id' ";
                                $result7 = $conn->query($sql7);
                                if ($result7->num_rows > 0) 
                                {
                                    while ($row = $result6->fetch_assoc()) 
                                    {
                                        $compteur = $row['VOTE'] + 1;                               
                                    }
                                }
                         
                                $sql2 = "UPDATE `reponse` SET `VOTE` = $compteur WHERE `ID` = '$id' ";
                                $result2 = $conn->query($sql2);
                            
                                $sql5 = "UPDATE `reponse` SET `VOTE` = '$nb_vote' WHERE `ID` = '$check2' ";
                                $result5 = $conn->query($sql5);

                                $sql4 = "UPDATE `vote` SET `ID_REPONSE` = $id WHERE `AUTHOR` = '$_SESSION[PSEUDO]' AND `ID_QUESTION` = '$id_question' ";
                                $result4 = $conn->query($sql4);

                                $sql8 = "UPDATE `vote` SET `BOOL` = '-1' WHERE `ID_REPONSE` = '$check2' ";
                                $result8 = $conn->query($sql8);
                            }
                            else
                            {
                                
                            $sql6 = "SELECT * FROM `reponse` WHERE `ID` = '$check2' ";
                                $result6 = $conn->query($sql6);
                                if ($result6->num_rows > 0) 
                                {
                                    while ($row = $result6->fetch_assoc()) 
                                    {
                                        $nb_vote = $row['VOTE'] + 1;                               
                                    }
                                }

                            $sql5 = "UPDATE `vote` SET `BOOL` = '1' WHERE `ID_REPONSE` = '$check2' ";
                            $result5 = $conn->query($sql5);

                            $sql4 = "UPDATE `reponse` SET `VOTE` = $nb_vote WHERE `ID` = '$id' ";
                            $result4 = $conn->query($sql4);
                            }
                        }
                        else if ($check == 1)
                        {
                            if ( $check2 != $id)   
                            {  
                                $sql6 = "SELECT * FROM `reponse` WHERE `ID` = '$check2' ";
                                $result6 = $conn->query($sql6);
                                if ($result6->num_rows > 0) 
                                {
                                    while ($row = $result6->fetch_assoc()) 
                                    {
                                        $nb_vote = $row['VOTE'] - 1;                               
                                    }
                                }

                                $sql7 = "SELECT * FROM `reponse` WHERE `ID` = '$id' ";
                                $result7 = $conn->query($sql7);
                                if ($result7->num_rows > 0) 
                                {
                                    while ($row = $result6->fetch_assoc()) 
                                    {
                                        $compteur = $row['VOTE'] + 1;                               
                                    }
                                }
                                

                                $sql2 = "UPDATE `reponse` SET `VOTE` = $compteur WHERE `ID` = '$id' ";
                                $result2 = $conn->query($sql2);
                            
                                $sql5 = "UPDATE `reponse` SET `VOTE` = '$nb_vote' WHERE `ID` = '$check2' ";
                                $result5 = $conn->query($sql5);

                                $sql4 = "UPDATE `vote` SET `ID_REPONSE` = $id WHERE `AUTHOR` = '$_SESSION[PSEUDO]' AND `ID_QUESTION` = '$id_question' ";
                                $result4 = $conn->query($sql4);
                            }
                        }
                    }
                    else
                    {
                        ?><h2>Auto vote impossible mon gars</h2><?php
                    }
            }
        }
    }
    return true;
}
function vote_function_dec($id,$id_question)
{
    $compteur = 0;
    include "SQL_table_connexion.php"; // Inclure le fichier
    $conn = connect(); // On se connecte à la base de données
    $sql = "SELECT * FROM `reponse`";
    $result = $conn->query($sql);
    $author = $_SESSION["PSEUDO"];
    $bool = 1;
    
    $check = NULL;
    $check2 = NULL;
    $nb_vote = NULL;

    $sql3 = "SELECT * FROM `vote` WHERE `AUTHOR` = '$_SESSION[PSEUDO]' AND `ID_QUESTION` = '$id_question' ";
    $result3 = $conn->query($sql3);
    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) 
        {
            $check = $row['BOOL'];
            $check2 = $row['ID_REPONSE'];
        }
    }
    

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
                if ($id == $row["ID"]) {
                    if ($_SESSION["PSEUDO"] != $row["AUTHOR"])
                    {
                        if ( ($check== 0))
                        {
                            
                            $sql6 = "SELECT * FROM `reponse` WHERE `ID` = '$id' ";
                            $result6 = $conn->query($sql6);
                            if ($result6->num_rows > 0) 
                            {
                                while ($row = $result6->fetch_assoc()) 
                                {
                                    $nb_vote = $row['VOTE']-1;                               
                                }
                            }
                    
                        $sql2 = "UPDATE `reponse` SET `VOTE` = $nb_vote WHERE `ID` = '$id' ";
                        $result2 = $conn->query($sql2);

                        $sql4 = "INSERT INTO `vote` (`AUTHOR`,`ID_QUESTION`,`BOOL`,`ID_REPONSE`)
                            VALUES ('$author','$id_question','-1','$id')";

                        $result4 = $conn->query($sql4);
                        }
                        else if ($check == 1)
                        {
                            if ( $check2 != $id)   
                            {   
                            
                                $sql6 = "SELECT * FROM `reponse` WHERE `ID` = '$check2' ";
                                $result6 = $conn->query($sql6);
                                if ($result6->num_rows > 0) 
                                {
                                    while ($row = $result6->fetch_assoc()) 
                                    {
                                        $nb_vote = $row['VOTE'] - 1;                               
                                    }
                                }

                                $sql7 = "SELECT * FROM `reponse` WHERE `ID` = '$id' ";
                                $result7 = $conn->query($sql7);
                                if ($result7->num_rows > 0) 
                                {
                                    while ($row = $result6->fetch_assoc()) 
                                    {
                                        $compteur = $row['VOTE'] - 1;                               
                                    }
                                }
                         
                                $sql2 = "UPDATE `reponse` SET `VOTE` = $compteur WHERE `ID` = '$id' ";
                                $result2 = $conn->query($sql2);
                            
                                $sql5 = "UPDATE `reponse` SET `VOTE` = '$nb_vote' WHERE `ID` = '$check2' ";
                                $result5 = $conn->query($sql5);

                                $sql4 = "UPDATE `vote` SET `ID_REPONSE` = $id WHERE `AUTHOR` = '$_SESSION[PSEUDO]' AND `ID_QUESTION` = '$id_question' ";
                                $result4 = $conn->query($sql4);

                                $sql7 = "UPDATE `vote` SET `BOOL` = '-1' WHERE `ID_REPONSE` = '$check2' ";
                                $result7 = $conn->query($sql7);


                            }
                            else
                            {
                            $sql6 = "SELECT * FROM `reponse` WHERE `ID` = '$check2' ";
                                $result6 = $conn->query($sql6);
                                if ($result6->num_rows > 0) 
                                {
                                    while ($row = $result6->fetch_assoc()) 
                                    {
                                        $nb_vote = $row['VOTE'] - 1;                               
                                    }
                                }

                            $sql5 = "UPDATE `vote` SET `BOOL` = '-1' WHERE `ID_REPONSE` = '$check2' ";
                            $result5 = $conn->query($sql5);

                            $sql4 = "UPDATE `reponse` SET `VOTE` = $nb_vote WHERE `ID` = '$id' ";
                            $result4 = $conn->query($sql4);
                            }
                        }
                        else if ($check == -1)
                        {
                            if ( $check2 != $id)   
                            {  
                                $sql6 = "SELECT * FROM `reponse` WHERE `ID` = '$check2' ";
                                $result6 = $conn->query($sql6);
                                if ($result6->num_rows > 0) 
                                {
                                    while ($row = $result6->fetch_assoc()) 
                                    {
                                        $nb_vote = $row['VOTE'] + 1;                               
                                    }
                                }

                                $sql7 = "SELECT * FROM `reponse` WHERE `ID` = '$id' ";
                                $result7 = $conn->query($sql7);
                                if ($result7->num_rows > 0) 
                                {
                                    while ($row = $result6->fetch_assoc()) 
                                    {
                                        $compteur = $row['VOTE'] - 1;                               
                                    }
                                }
                                

                                $sql2 = "UPDATE `reponse` SET `VOTE` = $compteur WHERE `ID` = '$id' ";
                                $result2 = $conn->query($sql2);
                            
                                $sql5 = "UPDATE `reponse` SET `VOTE` = '$nb_vote' WHERE `ID` = '$check2' ";
                                $result5 = $conn->query($sql5);

                                $sql4 = "UPDATE `vote` SET `ID_REPONSE` = $id WHERE `AUTHOR` = '$_SESSION[PSEUDO]' AND `ID_QUESTION` = '$id_question' ";
                                $result4 = $conn->query($sql4);
                            }
                        }
                    else
                    {
                        ?><h2>Auto vote impossible mon gars</h2><?php
                    }
            }
        }
    }
    }
    return true;
}
?>