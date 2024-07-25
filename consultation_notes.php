<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_notes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}


if (isset($_GET['matricule'])) {
    $matricule = $_GET['matricule'];
    $nom = $_GET['nom'];

    echo "$nom <br>";
    
    $sql = "SELECT * FROM NOTES  WHERE matricule = '$matricule'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $note1 = $row['TP1'];
        $note2 = $row['TP2'];
        $note3 = $row['TP3'];
        $Total = $row['Total'];
    } else {
     
        $note1 = $note2 = $note3 = "Aucune note trouvée";
    }
} else {
    header("Location: etudiant.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consultation des Notes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Consultation des Notes</h2>
        <p>Nom de l'étudiant : <?php echo $nom; ?></p>
        <p>Matricule : <?php echo $matricule; ?></p>
        <p>TP 1 : <?php echo $note1; ?></p>
        <p>TP 2 : <?php echo $note2; ?></p>
        <p>TP 3 : <?php echo $note3; ?></p>
        <p>Note finale : <?php echo $Total; ?></p>
        <p><a href="depot_requete.php?matricule=<?php echo $matricule; ?>">Déposer une Requête</a></p>
    </div>
</body>
</html>
