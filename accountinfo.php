<html>

<head>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/ticket.css">
    <?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    if($_SESSION['ouvert'] == false){
        header("location: connection.php"); // Bloqué l'accès si pas connecté
    }
    
    ?>
</head>

<body style="background-color: #343A40;">
    <!-- NAVBAR by Asyjan -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php"> <img src="/image/logo.png" height="32" width="32"> StudyCorp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-stretch" id="navbar7">
                <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <?php
                    if ($_SESSION['ouvert'] == true) {
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='blacklist.php'>BlackList</a>";
                        echo "</li>";
                    }
                    ?>
                    <?php
                    if ($_SESSION['ouvert'] == true) {
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='conseil.php'>Conseil</a>";
                        echo "</li>";
                    }
                    ?>
                    <?php
                    if ($_SESSION['ouvert'] == true) {
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link active' href='accountinfo.php'>Profil</a>";
                        echo "</li>";
                    }
                    ?>
                    <?php
                    if ($_SESSION['ouvert'] == true) {
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link ' href='uploads.php'>Upload</a>";
                        echo "</li>";
                    }
                    ?>
                    <li class="nav-item">
                        <?php
                        if ($_SESSION['ouvert'] == true) {
                            echo "<a class='nav-link' href='deconnexion.php'>Deconnexion</a>";
                        } else {
                            echo "<a class='nav-link' href='connection.php'>Connexion</a>";
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                    <?php
                    if ($_SESSION['ouvert'] == true) {
                        echo "<a class='nav-link'>" . $_SESSION['pseudo'] . "</a>";
                    }
                    ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- BODY by Asyjan -->
    <img src="/image/profillogo.png" alt="Profil logo" style="width:48px;height:48px; position: absolute; top: 200 px; left: 200 px;margin:20px;"> 
    <div id="principal_titre">Bienvenue <?php echo $_SESSION['pseudo'];?></div>
    <div id="info_compte">
    <div style="display: block; width: 20%;border:2px solid #000;border-radius:6px 6px 6px 6px; ">
    <p>Nombre de commandes : <?php echo $_SESSION['nbcommandes']; ?></p>
    </div>
    </div>
    <!------------------------------------- PARTIE DES TICKETS --------------------------------->
    <?php

$dir = "transcripts/pris-".$_SESSION['pseudo'];
function titre($titre) {
	$return = str_replace('.html', '', $titre);	
	$return = str_replace('pris-', '<img src="ticket.png">', $return);
	$return = str_replace('-1-', ' 01 ', $return);
	$return = str_replace('-2-', ' 02 ', $return);
	$return = str_replace('-3-', ' 03 ', $return);
	$return = str_replace('-4-', ' 04 ', $return);
	$return = str_replace('-5-', ' 05 ', $return);
	$return = str_replace('-6-', ' 06 ', $return);
	$return = str_replace('-7-', ' 07 ', $return);
	$return = str_replace('-8-', ' 08 ', $return);
	$return = str_replace('-9-', ' 09 ', $return);
	$return = str_replace('-10-', ' 10 ', $return);
	$return = str_replace('-11-', ' 11 ', $return);
	$return = str_replace('-12-', ' 12 ', $return);
	$return = str_replace('-', ' ', $return);
	return $return;
}
?>
  <div id="durba_list">
	<div id="durba_titre">Commandes réalisées</div>
	<div id="durba_content">
<?php
$dirs = dir($dir);
while($entry = $dirs->read()) {
	if(strlen($entry) > 4) {
		echo "<a href=\"#\" onclick='display(\"".$dir."/".$entry."\");'>".titre($entry)."</a><br>\n";
	}
}
$dirs->close();
?>
</div>
	</div>
	<div id="durba_contenu">
	<div id="durba_titre">Transcript</div>
	<div id="durba_page">
	</div>
	</div>
<script>
function display(id) {
$.ajax({
    url: "fichier.php?id=" +id, 
    type: $(this).attr('method'), 
    data: $(this).serialize(), 
    success: function(html) { 
    if(html != "ok") {
        document.getElementById("durba_page").innerHTML = '<div class="warning_r">' + html + '</div><style>.message-container {width:580px; word-wrap: break-word;} body {background-color: transparent;color: black;font-family: "Whitney", "Helvetica Neue", Helvetica, Arial, sans-serif;font-size: 16px;}</style>';
        }
        else {
            document.getElementById("durba_page").innerHTML = '<div class="warning_v">Vous êtes maintenant connecté, veuillez patienter...</div>';
            }
            }
            });
        }</script>
<!------------------------------------- FIN PARTIE DES TICKETS --------------------------------->
</body>

</html>