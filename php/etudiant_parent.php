<?php
// filepath: c:\xampp\htdocs\universite\php\ajouter_etudiant_parent.php
$host = 'localhost';
$user = 'root';
$pass = '2526';
$db = 'inscription';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die("Connexion échouée: " . $conn->connect_error); }

$stmt = $conn->prepare("INSERT INTO Etudiant_Parent (ID_Etudiant, ID_Parent, role) VALUES (?, ?, ?)");
$stmt->bind_param("iis",
    $_POST['ID_Etudiant'],
    $_POST['ID_Parent'],
    $_POST['role']
);

if ($stmt->execute()) {
    echo "Liaison ajoutée !";
} else {
    echo "Erreur: " . $conn->error;
}
$stmt->close();
$conn->close();
?>