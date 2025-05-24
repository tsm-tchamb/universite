<?php
// filepath: c:\xampp\htdocs\universite\php\ajouter_parent.php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'inscription';

$conn = new mysqli($host, $user, $pass, $db, );
if ($conn->connect_error) { die("Connexion échouée: " . $conn->connect_error); }

$stmt = $conn->prepare("INSERT INTO Parent (ID_Parent, Nom_Parent, Prenom_parent, Adresse_parent, Num_parent, Fonction, Lieu_Travail) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssiss",
    $_POST['ID_Parent'],
    $_POST['Nom_Parent'],
    $_POST['Prenom_parent'],
    $_POST['Adresse_parent'],
    $_POST['Num_parent'],
    $_POST['Fonction'],
    $_POST['Lieu_Travail']
);

if ($stmt->execute()) {
    echo "Parent ajouté !";
} else {
    echo "Erreur: " . $conn->error;
}
$stmt->close();
$conn->close();
?>