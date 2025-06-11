<?php
session_start();

require 'db_connect.php';

$conn = dbConnect();

// Hent highscores
$stmt = $conn->query("SELECT player, score FROM highscore ORDER BY score DESC");
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
            //navbar
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
