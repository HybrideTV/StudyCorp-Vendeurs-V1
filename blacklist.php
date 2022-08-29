<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();
    if($_SESSION['ouvert'] == false){
        header("location: connection.php"); // Bloqué l'accès si pas connecté
    }

    function findAll()
    {
        include 'database.php';
        $result = $objPdo->query("SELECT * FROM `blacklist`");
        $i = 1;
        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<th scope='row'>" . $i . "</th>";
            echo "<td>" . $row['user'] . "</td>";
            echo "<td>" . $row['pseudo'] . "</td>";
            echo "<td>" . $row['reason'] . "</td>";
            if($_SESSION['id'] == 1){
                echo "<td>"; echo '<a href="supprimer.php?id='.$row['id'] .'" > Supprimer </a>'; echo "</td>";
            }
            echo "</tr>";
            $i++;
        }
    }

    function findByUserId()
    {
        include 'database.php';
        $result = $objPdo->query("SELECT * FROM `blacklist` WHERE `user` LIKE '".$_POST['userID']."%'");
        $i = 1;
        $row = $result->fetch();
        if(count($row) > 1){
            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<th scope='row'>" . $i . "</th>";
                echo "<td>" . $row['user'] . "</td>";
                echo "<td>" . $row['pseudo'] . "</td>";
                echo "<td>" . $row['reason'] . "</td>";
                if($_SESSION['id'] == 1){
                    echo "<td>"; echo '<a href="supprimer.php?id='.$row['id'] .'" > Supprimer </a>'; echo "</td>";
                }
                echo "</tr>";
                $i++;
            }
        }else{
            echo "<h1 style='color: red;'> Aucun résultat trouvé !</h1>";
        }
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
                        echo "<a class='nav-link active' href='#'>BlackList</a>";
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
    <div class="container-fluid">
        <div class="searchBar">
            <form class="form-inline my-2 my-lg-0" method="POST">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="userID">
                <button class="btn btn-dark" type="submit">Check</button>
            </form>
        </div>
        <table class="table table-striped table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Raison</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['userID']) && $_POST['userID'] != ""){
                        findByUserId($_POST['userID']);
                    }else{
                        findAll();
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>