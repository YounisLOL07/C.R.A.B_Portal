<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>C.R.A.B Portal</title>
    <style>
        
        .logged-in {
            color:white;
        }
    </style>
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

        <h3>This is the Crab Portal!</h3>

        <div class="games">
            <div class="clicker_game_card">
                <img src="" alt="">
                <h4>Clicker Game</h4>
                <a href="clicker_game.php">Click play!</a>

            </div>

        </div>

        <!-- <div class="footer">
            C.R.A.B Game. All rights reserved
        </div> -->
        
    </div>
</body>
</html>