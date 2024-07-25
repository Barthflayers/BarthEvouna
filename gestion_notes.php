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
    $matricule = $_POST['matricule'];
    $note1 = $_POST['note1'];
    $note2 = $_POST['note2'];
    $note3 = $_POST['note3'];

    $total = ($note1 + $note2 + $note3) / 3;

   
    $nom = mysqli_real_escape_string($conn, $nom);
    $matricule = mysqli_real_escape_string($conn, $matricule);
    $note1 = mysqli_real_escape_string($conn, $note1);
    $note2 = mysqli_real_escape_string($conn, $note2);
    $note3 = mysqli_real_escape_string($conn, $note3);
    $total = mysqli_real_escape_string($conn, $total);

    
    $verif_etu = "SELECT * FROM ETUDIANTS WHERE matricule = '$matricule'";
    $verif_etu = $conn->query($verif_etu);

    if ($verif_etu->num_rows > 0) {
     
        $sql = "INSERT INTO NOTES (nom, matricule, TP1, TP2, TP3, Total) 
                VALUES ('$nom', '$matricule', '$note1', '$note2', '$note3', '$total')";

        if ($conn->query($sql) === TRUE) {
           
            $success_message = "Notes enregistrées avec succès.";
        } else {
          
            $error_message = "Erreur d'insertion : " . $conn->error;
        }
    } else {
      
        $error_message = "Matricule d'étudiant invalide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Notes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Gestion des Notes</h2>
        <?php if (!empty($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } elseif (!empty($success_message)) { ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>
            <label for="matricule">Matricule :</label>
            <input type="text" id="matricule" name="matricule" required><br><br>
            <label for="note1">Note 1 :</label>
            <input type="text" id="note1" name="note1" required><br><br>
            <label for="note2">Note 2 :</label>
            <input type="text" id="note2" name="note2" required><br><br>
            <label for="note3">Note 3 :</label>
            <input type="text" id="note3" name="note3" required><br><br>
            <button type="submit">Enregistrer les Notes</button>
        </form>
        <p><a href="gestion_requetes.php">Gestion des requetes </a></p>
    </div>
</body>
</html>
