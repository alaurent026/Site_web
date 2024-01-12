<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>stack over eirb</title>
  <link href='menu.css' rel='stylesheet'>
</head>

<body>

  <?php
  session_start(); // On ouvre la session

  ?>
  <header id="menuheader">
    <h1>stack over eirb</h1>
    <h2><button id="menu" onclick="window.location.href='home.php';"> accueil </button> </h2>
    <?php
    if (isset($_SESSION["PSEUDO"])) {
    ?>
      <h2><button id="menu" onclick="window.location.href='forum.php';"> poser une question </button> </h2>
      <h2><button id="menu" onclick="window.location.href='user_profile.php?editing=0&idquestion=0&idreponse=0';"> Profil </button></h2>
      <h2><button id="menu" onclick="window.location.href='all_questions.php';">Toutes les questions</button></h2>
      <h2><button id="menu" onclick="window.location.href='unanswered_questions.php';">Questions non répondues</button></h2>
      <form action="<?php $_PHP_SELF; ?>" method="post">
        <h2><button id="menu" name="submit2" onclick="window.location.href='deconnexion.php';"> déconnexion </button></h2>
      </form>

      <?php
      if (isset($_POST["submit2"])) {
        include "SQL_table_connexion.php";
        if (isset($_SESSION)) {
          $_SESSION["PSEUDO"] = NULL;
          header('Location: home.php');
        }
      }
      ?>
      <h2 id="log"><?php echo "tu es connecté  " . "  $_SESSION[PSEUDO]"; ?></h2>
    <?php
    } else { ?>
      <h2><button id="menu" onclick="window.location.href='inscription.php';"> inscription</button> </h2>
      <h2><button id="menu" onclick="window.location.href='connexion.php';">connexion</button> </h2>
    <?php
    }
    ?>
  </header>
</body>

</html>