<?php
// filepath: c:\xampp\htdocs\universite\php\ajouter_inscription.php
$host = 'localhost';
$user = 'root';
$pass = '2526';
$db = 'inscription';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die("Connexion échouée: " . $conn->connect_error); }

$stmt = $conn->prepare("INSERT INTO inscription (ID_Etudiant, ID_Etablissement, ref, Date_Inscription) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiis",
    $_POST['ID_Etudiant'],
    $_POST['ID_Etablissement'],
    $_POST['ref'],
    $_POST['Date_Inscription']
);

if ($stmt->execute()) {
    echo "Inscription ajoutée !";
} else {
    echo "Erreur: " . $conn->error;
}
$stmt->close();
$conn->close();
?>