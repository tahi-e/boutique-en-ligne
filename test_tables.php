<?php
$mysqli = new mysqli('localhost', 'root', '', 'commande_site');

if ($mysqli->connect_errno) {
    die("Erreur de connexion : " . $mysqli->connect_error);
}

$result = $mysqli->query("SHOW TABLES");
echo "Tables dans la base commande_site :<br>";
while ($row = $result->fetch_array()) {
    echo "- " . $row[0] . "<br>";
}
?>
