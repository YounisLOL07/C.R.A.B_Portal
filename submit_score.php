<?php
// Koble til databasen
$servername = "10.2.2.100";
$username = "younis_admin";
$password = "admin123";
$dbname = "crab_game";
//Dette lar all tegn være med på databasen.
$charset = 'utf8mb4';

$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $player = htmlspecialchars($_POST['player']);
    $score = intval($_POST['score']);

    $stmt = $pdo->prepare("INSERT INTO highscore (player, score) VALUES (?, ?)");
    $stmt->execute([$player, $score]);
    header("Location: clicker_game.php");
    exit();
}
?>
