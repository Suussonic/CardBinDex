<?php
include 'db.php'; // Inclure le fichier de connexion à la base de données

// Handle deletion
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM captcha WHERE id = :id";
    $stmt = $dbh->prepare($delete_sql);
    $stmt->execute([':id' => $delete_id]);

    // Redirect to the same page to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Définir la requête SQL pour récupérer les données de la table captcha
$sql = "SELECT id, firstname, lastname, email, password, gender, theme, roole FROM users";
$stmt = $dbh->query($sql); // Exécuter la requête
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage du Captcha</title>
    <style>
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-table, .admin-table th, .admin-table td {
            border: 1px solid black;
        }
        .admin-table th, .admin-table td {
            padding: 8px;
            text-align: left;
        }
        .admin-table th {
            background-color: #007bff;
            color: white;
        }
        .action-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            display: inline;
        }
        .action-button:hover {
            background-color: #c82333;
        }
        .action-form {
            display: inline;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Password</th>
        <th>Gender</th>
        <th>Theme</th>
        <th>Role</th>
    </tr>
    <?php
    if ($stmt->rowCount() > 0) {
        // Afficher les données de chaque ligne
        while ($row = $stmt->fetch()) {
            echo "<tr>
                <td>" . htmlspecialchars($row["id"]) . "</td>
                <td>" . htmlspecialchars($row["firstname"]) . "</td>
                <td>" . htmlspecialchars($row["lastname"]) . "</td>
                <td>" . htmlspecialchars($row["email"]) . "</td>
                <td>" . htmlspecialchars($row["password"]) . "</td>
                <td>" . htmlspecialchars($row["gender"]) . "</td>
                <td>" . htmlspecialchars($row["theme"]) . "</td>
                <td>" . htmlspecialchars($row["roole"]) . "</td>
            </tr>";
        }
    } else {
        // Si aucun enregistrement n'est trouvé, afficher un message
        echo "<tr><td colspan='4'>0 résultats</td></tr>";
    }
    ?>
</table>

</body>
</html>
