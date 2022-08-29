<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
if($_SESSION['ouvert'] == false){
    header("location: connection.php"); // Bloqué l'accès si pas connecté
}

    if(isset($_FILES['fichier']) && $_FILES['fichier']['error'] == 0){
        $error = 1;
        if($_FILES['fichier']['size'] <= 3000000){
            $informationFiles = pathinfo($_FILES['fichier']['name']);
            $extensionFiles = $informationFiles['extension'];
            $extensionArray = array('zip', 'rar', 'pdf', '7zip', 'jpg', 'png', 'gif', 'jpeg');

            if(in_array($extensionFiles, $extensionArray)){
                $address = 'uploads/'.time().rand().'.'.$extensionFiles;
                move_uploaded_file($_FILES['fichier']['tmp_name'], $address);
                $error = 0;
            }
        }
    }
?>
<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/conseil.css">
    <link rel="stylesheet" href="CSS/buttons.scss">
    
</head>

<body style="background-color: #343A40;">
    
    <!-- NAVBAR by Asyjan -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php"> <img src="image/logo.png" height="32" width="32"> StudyCorp</a>
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
                        echo "<a class='nav-link ' href='conseil.php'>Conseil</a>";
                        echo "</li>";
                    }
                    ?>
                    <?php
                    if ($_SESSION['ouvert'] == true) {
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link ' href='accountinfo.php'>Profil</a>";
                        echo "</li>";
                    }
                    ?>
                    <?php
                    if ($_SESSION['ouvert'] == true) {
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link active' href='uploads.php'>Upload</a>";
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
    <style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 12px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  border-radius:12px 12px 12px 12px;
  cursor: pointer;
}
.button1 {
  background-color: white; 
  color: black; 
  border: 3px solid #4CAF50;
  border-radius:12px 12px 12px 12px;
}
.button1:hover {
  background-color: #4CAF50;
  color: white;
  border-radius:12px 12px 12px 12px;
}
}
</style>

<form method="post" action ="index.php" enctype="multipart/form-data">
            <p>
            <font color="white" size="5"><center>
            <input type="file" name="fichier"/>
            <br>
            <br>
            <button class="button button1" type="submit">Upload</button>
             </center></font>
            <br>
            <br>
            <center>
            <?php
                if(isset($error) && $error == 0){
                    echo'<input type="text" size="50" value="http://localhost/'.$address.'"/>';
                    echo'Pensez à sauvegarder le lien ! Il ne sera pas possible de le récupérer !';
                }else if(isset($error) && $error == 1){
                    echo'Votre image ne peut pas être envoyée.';
                    echo'Extensions autorisées : zip, rar, pdf, 7zip, jpg, png, gif, jpeg';
                    echo'Taille maximale : 250Mo';
                }
            ?></center>
            </p>
        </form>
</body>

</html>