<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'inscription';

$conn = new mysqli($host, $user, $pass, $db, );
if ($conn->connect_error) { die("Connexion échouée: " . $conn->connect_error); }

$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

$stmt = $conn->prepare("SELECT id, mot_de_passe, id_etudiant FROM compte WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    $stmt->bind_result($id, $hash, $id_etudiant);
    $stmt->fetch();
    if(password_verify($mot_de_passe, $hash)){
        $_SESSION['id_compte'] = $id;
        $_SESSION['id_etudiant'] = $id_etudiant;
        echo "success";
    } else {
        echo "Mot de passe incorrect.";
    }
} else {
    echo "Email non trouvé.";
}
$stmt->close();
$conn->close();
?>