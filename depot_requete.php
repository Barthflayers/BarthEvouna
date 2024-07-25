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
$matricule = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $objet = $_POST['objet'];
    $message = $_POST['message'];


    $matricule = mysqli_real_escape_string($conn, $matricule);
    $nom = mysqli_real_escape_string($conn, $nom);
    $objet = mysqli_real_escape_string($conn, $objet);
    $message = mysqli_real_escape_string($conn, $message);

 
    $verif_etu = "SELECT * FROM ETUDIANTS WHERE matricule = '$matricule'";
    $verif_etu = $conn->query($verif_etu);

    if ($verif_etu->num_rows > 0) {
       
        $sql = "INSERT INTO DEPOT_REQUETES (matricule, nom, objet, message) 
                VALUES ('$matricule','$nom', '$objet', '$message')";

        if ($conn->query($sql) === TRUE) {
          
            $success_message = "Requête déposée avec succès.";
            
         
        } else {
         
            $error_message = "Erreur d'insertion : " . $conn->error;
        }
    } else {
   
        $error_message = "Matricule d'étudiant invalide.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dépôt de Requête</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Dépôt de Requête</h2>
        <?php if (!empty($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } elseif (!empty($success_message)) { ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="matricule">Matricule :</label>
            <input type="text" id="matricule" name="matricule" required><br><br>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>
            <label for="objet">Objet :</label>
            <input type="text" id="objet" name="objet" required><br><br>
            <label for="message">Message :</label><br>
            <textarea id="message" name="message" rows="4" required></textarea><br><br>
            <button type="submit">Déposer la Requête</button>
        </form>
         <p><a href="index.php">Retourner à accueil </a></p>
    </div>
</body>
</html>
