<?php
// filepath: c:\xampp\htdocs\universite\php\ajouter_etablissement.php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'inscription';

$conn = new mysqli($host, $user, $pass, $db, );
if ($conn->connect_error) { die("Connexion échouée: " . $conn->connect_error); }

$stmt = $conn->prepare("INSERT INTO Etablissement (ID_Etablissement, Libelle_Etablissement, Parcours) VALUES (?, ?, ?)");
$stmt->bind_param("iss",
    $_POST['ID_Etablissement'],
    $_POST['Libelle_Etablissement'],
    $_POST['Parcours']
);

if ($stmt->execute()) {
    echo "Etablissement ajouté !";
} else {
    echo "Erreur: " . $conn->error;
}
$stmt->close();
$conn->close();
?>