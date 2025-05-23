 
 <?php
// filepath: C:\xampp\htdocs\universite\php\ajouter_etudiant.php
$host = 'localhost';
$user = 'root';
$pass = '2526';
$db = 'inscription';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die("Connexion échouée: " . $conn->connect_error); }

$stmt = $conn->prepare("INSERT INTO Etudiant (ID_Etudiant, Nom_Etudiant, Email, Date_Naissance, Statut, Nationalite, Ref_Diplome, Num_tel, Prenom_etudiant, Adresse, ID_Piece) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssisss",
    $_POST['ID_Etudiant'],
    $_POST['Nom_Etudiant'],
    $_POST['Email'],
    $_POST['Date_Naissance'],
    $_POST['Statut'],
    $_POST['Nationalite'],
    $_POST['Ref_Diplome'],
    $_POST['Num_tel'],
    $_POST['Prenom_etudiant'],
    $_POST['Adresse'],
    $_POST['ID_Piece']
);

if ($stmt->execute()) {
    echo "Étudiant ajouté !";
} else {
    echo "Erreur: " . $conn->error;
}
$stmt->close();
$conn->close();
?>