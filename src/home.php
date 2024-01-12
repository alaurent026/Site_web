<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
</head>

<body>
	<header>
		<?php
		include "menu.php";
		?>
	</header>


	<h2 id="questions"><?php
	if (isset($_SESSION["PSEUDO"])){

	
						include "SQL_table_connexion.php"; // Inclure le fichier
						$conn = connect();
						$sql = " SELECT * FROM `question` ORDER BY `id` DESC";
						$compt = 0;
						echo "Questions les plus récentes : ";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) 
						{
							while ($row = $result->fetch_assoc()) 
							{
								if ($compt < 3) 
								{
						?><section id="forum"><?php
												echo "$row[OBJECT]";
												?>
						<button id="forum" onclick="window.location.href='reponse.php?idquestion=<?php echo $row['ID']?>&idreponse=<?php echo 0?>&type=<?php echo 0?>';"> Réponses</button>
			<?php
									$compt++;
								}
							}
						} 
						else 
						{
							echo " pas encore de questions sur notre beau forum";
						}

					
		?>
				

					</section>

	</h2>


	<h2 id="questions"><?php
						include "SQL_table_connexion.php"; // Inclure le fichier
						$conn = connect();
						$sql = " SELECT * FROM `question` ORDER BY `NB_REPONSE` ASC";
						$compt = 0;
						echo "Questions les plus populaires : ";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								if ($compt < 3) {
						?>
					<section id="forum"><?php
										echo "$row[OBJECT] ";
										?>
						<button id="forum" onclick="window.location.href='reponse.php?idquestion=<?php echo $row['ID']?>&idreponse=<?php echo 0?>&type=<?php echo 0?>';"> Réponses</button>
			<?php
									$compt++;
								}
							}
						} else 
						{
							echo " pas encore de questions sur notre beau forum";
						}
			
					
	}
	else{
		echo " Connectez vous ou inscrivez vous pour accèder au site";
	}
	?>
		
	</h2> 
	</section>
</body>

</html>