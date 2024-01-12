<?php

include "src/SQL_ table_connexion.php";
$conn=connect();

$sql="CREATE TABLE IF NOT EXISTS `users` ( 
    `ID` INT NOT NULL AUTO_INCREMENT,
    `PSEUDO` VARCHAR(45) NULL SET utf8,
    `EMAIL` VARCHAR(45) NULL,
    `MDP` VARCHAR(45) NULL SET utf8, 
    PRIMARY KEY (`ID`)
)";
$result=$con->query($sql);

$sql="CREATE TABLE IF NOT EXISTS `question` ( 
    `ID` INT NOT NULL AUTO_INCREMENT,
    `AUTHOR` VARCHAR(45) NULL SET utf8,
    `DATE` VARCHAR(45) NULL,
    `CONTENT` VARCHAR(45) NULL SET utf8, 
    `NB_REPONSE` INT,
    `OBJECT` VARCHAR(45) SET utf8,
    PRIMARY KEY (`ID`)
)";
$result=$con->query($sql);

$sql="CREATE TABLE IF NOT EXISTS `reponse` ( 
    `ID` INT NOT NULL AUTO_INCREMENT,
    `AUTHOR` VARCHAR(45) NULL SET utf8,
    `ID_QUESTION` INT,
    `DATE` VARCHAR(45) NULL,
    `CONTENT` VARCHAR(45) NULL SET utf8, 
    `VOTE` INT,
    PRIMARY KEY (`ID`)
)";
$result=$con->query($sql);

$sql="CREATE TABLE IF NOT EXISTS `vote` ( 
    `ID` INT NOT NULL AUTO_INCREMENT,
    `AUTHOR` VARCHAR(45) NULL SET utf8,
    `ID_QUESTION` INT,
    `BOOL` INT,
    `ID_REPONSE` INT,
    PRIMARY KEY (`ID`)
)";
$result=$con->query($sql);

$sql="INSERT INTO `users` (`ID`,`PSEUDO`,`EMAIL`,`MDP`) VALUES
(0,'max','max@max.fr','max')
(1,'bob','bob@bob.fr','bob')";
$result=$con->query($sql);

$date=date('d-m-Y');

$sql="INSERT INTO `question` (`ID`,`AUTHOR`,`DATE`,`NB_REPONSE`,`OBJECT`) VALUES
(0,'max','$date','1','Hello?')";
$result=$con->query($sql);

$sql="INSERT INTO `reponse` (`ID`,`AUTHOR`,`ID_QUESTION`,`DATE`,`CONTENT`,`VOTE`) VALUES
(0,'bob','1','$date','Hello!',1)";
$result=$con->query($sql);

$sql="INSERT INTO `vote` (`ID`,`AUTHOR`,`ID_QUESTION`,`BOOL`,`ID_REPONSE`) VALUES
(0,'max',0,1,0)";
$result=$con->query($sql);

?>