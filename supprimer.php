<?php
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $mysqli = new mysqli('localhost', 'root', '', 'commande_site');

    if ($mysqli->connect_error) {
        die("Erreur de connexion : " . $mysqli->connect_error);
    }

    $sql = "DELETE FROM commandes WHERE id = $id";

    if ($mysqli->query($sql)) {
        header("Location: liste.php");
        exit();
    } else {
        echo "Erreur lors de la suppression : " . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "Aucun ID fourni.";
}
?>
