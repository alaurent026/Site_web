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
		?>
		<?php
?>
	</header>



<form id="question" action="<?php $_PHP_SELF; ?>" method="post">
	<input id="objetquestion" type="text" name="object" placeholder="Objet de votre votre question">
	<textarea id="corpsquestion" name="question" cols="30" rows="10" placeholder="rédigez votre question"></textarea>
	<input id="subquestion" type="submit" name="submit" value="Cliquez ici pour poster votre question" />

</form>
	<?php

	

	//Post d'une question
	if (isset($_POST["submit"])) {
		
		if ($_POST["question"] != NULL) {

			include "SQL_table_connexion.php"; // Inclure le fichier
			$conn = connect(); // On se connecte à la base de données

			$author = $_SESSION['PSEUDO'];
			$date = date('d-m-y h:i:s'); // Date du jour
			$object=$_POST["object"]; //contenu de l'objet
			$content = $_POST["question"]; //Contenu de la question

			$sql = "INSERT INTO `question` (`AUTHOR`,`DATE`,`CONTENT`,`OBJECT`)
  	VALUES ('$author','$date','$content','$object')";
			$result = $conn->query($sql); // On lance la requête
			if ($result === TRUE) {
				echo "Question crée, impec!";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} 
		else {
			echo " le champ ne peut être vide";
		}
		
	}


	?>

</body>

</html>