<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécurisation des données reçues
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $methode = htmlspecialchars($_POST['methode']);
    $date = htmlspecialchars($_POST['date']);

    // Affichage simple des données envoyées
    echo "<h2>Commande reçue :</h2>";
    echo "Nom : " . $nom . "<br>";
    echo "Email : " . $email . "<br>";
    echo "Méthode de paiement : " . $methode . "<br>";
    echo "Date : " . $date . "<br>";
} else {
    echo "Aucune donnée reçue.";
}
?>
