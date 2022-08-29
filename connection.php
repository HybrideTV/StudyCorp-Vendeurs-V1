<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" media="screen and (min-width:721px)" href="CSS/styleConnexion2.css" />
    <link rel="stylesheet" media="screen and (max-width:720px)" href="CSS/mobileConnexion2.css" />

    <?php
    include 'database.php';


    if(isset($_POST['username']) && isset($_POST['password']))
    {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = $objPdo->query("SELECT * FROM User WHERE username = '$username' AND password = '$password' ");
        $result->bindValue('username', $_POST['username'], PDO::PARAM_STR);
        $result->bindValue('password', $_POST['password'], PDO::PARAM_STR);
        $count = $result->rowCount();

        if($count == 1)
        {
            echo "Connexion avec un compte existant";
            session_start();
            
            $_SESSION['ouvert']=true;
            $stmt = $objPdo->query("SELECT * FROM User WHERE username = '$username'");
            $stmt->bindValue('username', $_POST['username'], PDO::PARAM_STR);
            $res = $stmt->fetch();

            $_SESSION['id']=$res['id'];
            $_SESSION['pseudo']=$res['username'];
            $_SESSION['nbcommandes']=$res['nbcommandes'];
            header("location: index.php");
        }
        else
        {
            echo "<p class=alert> Connexion avec un compte inexistant </p>";
        }
    }

    

    ?>

</head>
<body>

    <form class="box" method="POST">
        <h1> Connexion </h1>
        <input type="text" name="username" placeholder="Identifiant">
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="submit" name="valider" value="Valider" class="submit">
    </form>

</body>
</html>