<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'inscription';

$conn = new mysqli($host, $user, $pass, $db, );
if ($conn->connect_error) { die("Connexion échouée: " . $conn->connect_error); }

// 1. Créer une pièce vide (ou avec valeurs par défaut)
$stmt_piece = $conn->prepare("INSERT INTO piece (Acte_Naissance, Demande_Manuscrite, Releve_Note, Attestation, Casier_Judiciaire, Certificat_Nationalite) VALUES (0,0,0,0,0,0)");
$stmt_piece->execute();
$id_piece = $conn->insert_id;
$stmt_piece->close();

// 2. Insérer l'étudiant avec l'ID_Piece généré
$stmt = $conn->prepare("INSERT INTO etudiant (Nom_Etudiant, Email, Date_Naissance, Statut, Nationalite, Ref_Diplome, Num_tel, Prenom_etudiant, Adresse, ID_Piece) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssi",
    $_POST['Nom_Etudiant'],
    $_POST['Email'],
    $_POST['Date_Naissance'],
    $_POST['Statut'],
    $_POST['Nationalite'],
    $_POST['Ref_Diplome'],
    $_POST['Num_tel'],
    $_POST['Prenom_etudiant'],
    $_POST['Adresse'],
    $id_piece
);

if ($stmt->execute()) {
    $id_etudiant = $conn->insert_id;
    // 3. Créer le compte étudiant (mot de passe hashé)
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $stmt_compte = $conn->prepare("INSERT INTO compte (email, mot_de_passe, id_etudiant) VALUES (?, ?, ?)");
    $stmt_compte->bind_param("ssi", $_POST['Email'], $mot_de_passe, $id_etudiant);
    $stmt_compte->execute();
    $stmt_compte->close();
    echo "Inscription réussie !";
} else {
    echo "Erreur: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>