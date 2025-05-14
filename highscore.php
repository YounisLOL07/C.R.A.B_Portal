<?php
session_start();

// Koble til databasen
$servername = "10.2.2.100";
$username = "younis_admin";
$password = "admin123";
$dbname = "crab_game";
$charset = 'utf8mb4';

$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}

// Hent highscores
$stmt = $pdo->query("SELECT player, score FROM highscore ORDER BY score DESC");
$highscores = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Highscores</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="index.php">Home</a>
            <?php if (isset($_SESSION['username'])): ?>
                <span class="logged-in">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="sign_in.php">Sign In</a>
            <?php endif; ?>
            <a href="highscore.php">Highscore</a>
            <a href="FAQ.php">FAQ</a>
        </div>
                <div class="highscore-table">
            <h2>Highscores</h2>
            <table>
                <tr>
                    <th>Player</th>
                    <th>Score</th>
                </tr>
                <?php foreach ($highscores as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['player']) ?></td>
                        <td><?= $row['score'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    

</body>
</html>
