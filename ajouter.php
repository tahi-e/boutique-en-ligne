<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une commande</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; background-color: #f9f9f9; }
        h2 { color: #3f51b5; }
        form {
            background: white; padding: 20px;
            border-radius: 10px; max-width: 500px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="number"], input[type="email"] {
            width: 100%; padding: 10px; margin-bottom: 15px;
            border: 1px solid #ccc; border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #3f51b5; color: white;
            border: none; padding: 10px 20px;
            border-radius: 5px; cursor: pointer;
        }
        .link-btn {
            display: inline-block; margin-top: 20px;
            background-color: #4CAF50; color: white;
            padding: 10px 15px; text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>Ajouter une commande</h2>

<form method="post" action="">
    <label>Produit :</label>
    <input type="text" name="produit" required>

    <label>Quantité :</label>
    <input type="number" name="quantite" min="1" required>

    <label>Email :</label>
    <input type="email" name="email" required>

    <label>Numéro de téléphone :</label>
    <input type="text" name="numero_telephone" required>

    <input type="submit" name="submit" value="Ajouter">
</form>

<a href="liste.php" class="link-btn">Voir les commandes</a>

<?php
if (isset($_POST['submit'])) {
    $mysqli = new mysqli('localhost', 'root', '', 'commande_site');

    if ($mysqli->connect_error) {
        die("Erreur de connexion : " . $mysqli->connect_error);
    }

    $produit = $mysqli->real_escape_string($_POST['produit']);
    $quantite = (int)$_POST['quantite'];
    $email = $mysqli->real_escape_string($_POST['email']);
    $numero = $mysqli->real_escape_string($_POST['numero_telephone']);

    if ($quantite <= 0) {
        echo "<p style='color:red;'>❌ La quantité doit être supérieure à 0.</p>";
    } else {
        $sql = "INSERT INTO commandes (produit, quantite, email, numero_telephone)
                VALUES ('$produit', $quantite, '$email', '$numero')";

        if ($mysqli->query($sql)) {
            echo "<script>alert('✅ Commande ajoutée avec succès !');
            window.location.href = 'liste.php';</script>";
        } else {
            echo "<p style='color:red;'>Erreur : " . $mysqli->error . "</p>";
        }
    }

    $mysqli->close();
}
?>

</body>
</html>
