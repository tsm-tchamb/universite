<?php
// filepath: c:\xampp\htdocs\universite\php\ajouter_localisation.php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'inscription';

$conn = new mysqli($host, $user, $pass, $db, );
if ($conn->connect_error) { die("Connexion échouée: " . $conn->connect_error); }

$stmt = $conn->prepare("INSERT INTO Localisation (Ref, Libelle_Localisation, Ref_Possedee) VALUES (?, ?, ?)");
$stmt->bind_param("isi",
    $_POST['Ref'],
    $_POST['Libelle_Localisation'],
    $_POST['Ref_Possedee']
);

if ($stmt->execute()) {
    echo "Localisation ajoutée !";
} else {
    echo "Erreur: " . $conn->error;
}
$stmt->close();
$conn->close();
?>