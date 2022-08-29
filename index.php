<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    ?>
</head>

<body style="background-color: #343A40;">
    <!-- NAVBAR by Asyjan -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"> <img src="/image/logo.png" height="32" width="32">StudyCorp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-stretch" id="navbar7">
                <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="nav-link active" href="index.php">Accueil</a>
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
                        echo "<a class='nav-link ' href='accountinfo.php'>Profil</a>";
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
                            //echo "<a class='nav-link' href='connection.php'>Connexion</a>";
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
        <div style="display: block; margin-left: auto; margin-right: auto; width: 40%;">
        <br>
            <h2 style="color:white"><center>Bienvenue sur l’espace web vendeurs</center></h2>
            <br>
            <center><img src="/image/logo.png"> </center>
        </div>
</body>


</html>
