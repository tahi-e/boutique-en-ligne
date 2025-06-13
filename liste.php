<?php
$mysqli = new mysqli('localhost', 'root', '', 'commande_site');

if ($mysqli->connect_errno) {
    die("Erreur de connexion : " . $mysqli->connect_error);
}

$sql = "SELECT * FROM commandes ORDER BY id DESC";
$result = $mysqli->query($sql);

if (!$result) {
    die("Erreur SQL : " . $mysqli->error);
}

echo "<h2>Liste des commandes</h2>";

while ($row = $result->fetch_assoc()) {
    echo "<div style='margin-bottom:20px; padding:10px; border:1px solid #ccc;'>";

    echo "ID : " . $row['id'] . "<br>";
    echo "Produit : " . $row['produit'] . "<br>";
    echo "Quantité : " . $row['quantite'] . "<br>";
    echo "Email : " . $row['email'] . "<br>";
    echo "Téléphone : " . $row['numero_telephone'] . "<br>";

    // Lien de suppression
    echo "<a href='supprimer.php?id=" . $row['id'] . "' style='color:red;' onclick='return confirm(\"Supprimer cette commande ?\")'>
        Supprimer</a>";

    echo "</div>";
}

$mysqli->close();
?>
