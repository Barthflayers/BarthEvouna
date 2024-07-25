<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_notes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}



$sql = "SELECT * FROM DEPOT_REQUETES";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Requêtes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Gestion des Requêtes</h2>
        <?php if ($result->num_rows > 0) { ?>
            <table border =2px>
                <tr>
                    <th>ID de la requete</th>
                    <th>Matricule</th>
                    <th>Objet</th>
                    <th>Message</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['idrequete']; ?></td>
                        <td><?php echo $row['matricule']; ?></td>
                        <td><?php echo $row['objet']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>Aucune requête déposée pour le moment.</p>
        <?php } ?>
        <p><a href="index.php">Retourner à accueil </a></p>
        <p><a href="choix_enseignant.php">Aller à l'espace enseignant </a></p>
    </div>
</body>
</html>
