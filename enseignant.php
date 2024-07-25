<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_notes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $nom = mysqli_real_escape_string($conn, $nom);
    $mot_de_passe = mysqli_real_escape_string($conn, $mot_de_passe);

    $sql = "SELECT * FROM ENSEIGNANT WHERE nom = '$nom' AND mot_de_passe = '$mot_de_passe'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
     
        header("Location: choix_enseignant.php");
        exit();
    } else {
        $error_message = "Nom d'enseignant ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion Enseignant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Connexion Enseignant</h2>
        <?php if (!empty($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
