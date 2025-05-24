<?php
// filepath: c:\xampp\htdocs\universite\php\ajouter_piece.php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'inscription';

$conn = new mysqli($host, $user, $pass, $db, );
if ($conn->connect_error) { die("Connexion échouée: " . $conn->connect_error); }

$stmt = $conn->prepare("INSERT INTO Piece (ID_Piece, Acte_Naissance, Demande_Manuscrite, Releve_Note, Attestation, Casier_Judiciaire, Certificat_Nationalite) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiiiiii",
    $_POST['ID_Piece'],
    $_POST['Acte_Naissance'],
    $_POST['Demande_Manuscrite'],
    $_POST['Releve_Note'],
    $_POST['Attestation'],
    $_POST['Casier_Judiciaire'],
    $_POST['Certificat_Nationalite']
);

if ($stmt->execute()) {
    echo "Pièce ajoutée !";
} else {
    echo "Erreur: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>