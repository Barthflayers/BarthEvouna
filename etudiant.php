
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $matricule = mysqli_real_escape_string($conn, $matricule);
    $nom = mysqli_real_escape_string($conn, $nom);

    $sql = "SELECT * FROM ETUDIANTS WHERE matricule = '$matricule'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: consultation_notes.php?matricule=$matricule");
        exit();
    } else {
        $error_message = "Étudiant non trouvé. Veuillez vérifier votre matricule ou votre nom.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Étudiant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Connexion Étudiant</h2>
        <?php if (!empty($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nom">Nom de l'étudiant :</label>
            <input type="text" id="nom" name="nom" required><br>
            <label for="matricule">Matricule :</label>
            <input type="text" id="matricule" name="matricule" required><br>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
