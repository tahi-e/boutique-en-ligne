<?php
$mysqli = new mysqli('localhost', 'root', '', 'commande_site');

if ($mysqli->connect_errno) {
    die("Erreur de connexion : " . $mysqli->connect_error);
}

if (!isset($_GET['id'])) {
    die("ID de commande non spécifié.");
}

$id = (int)$_GET['id'];

echo "<p>ID reçu : $id</p>";

// Récupération des données actuelles
$sql = "SELECT * FROM commandes WHERE id=$id LIMIT 1";
$result = $mysqli->query($sql);

if (!$result || $result->num_rows === 0) {
    die("Commande introuvable.");
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produit = $mysqli->real_escape_string($_POST['produit']);
    $quantite = (int)$_POST['quantite'];
    $email = $mysqli->real_escape_string($_POST['email']);
    $numero_telephone = $mysqli->real_escape_string($_POST['numero_telephone']);

    $sql_update = "UPDATE commandes SET produit='$produit', quantite=$quantite, email='$email', numero_telephone='$numero_telephone' WHERE id=$id";

    if ($mysqli->query($sql_update)) {
        header("Location: liste.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . $mysqli->error;
    }
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier commande #<?php echo $id; ?></title>
</head>
<body>
    <h1>Modifier la commande #<?php echo $id; ?></h1>
    <form method="post" action="">
        <label>Produit:<br>
            <input type="text" name="produit" required value="<?php echo htmlspecialchars($row['produit']); ?>">
        </label><br><br>

        <label>Quantité:<br>
            <input type="number" name="quantite" min="1" required value="<?php echo (int)$row['quantite']; ?>">
        </label><br><br>

        <label>Email:<br>
            <input type="email" name="email" required value="<?php echo htmlspecialchars($row['email']); ?>">
        </label><br><br>

        <label>Téléphone:<br>
            <input type="text" name="numero_telephone" required value="<?php echo htmlspecialchars($row['numero_telephone']); ?>">
        </label><br><br>

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <p><a href="liste.php">Retour à la liste des commandes</a></p>
</body>
</html>
