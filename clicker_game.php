<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clicker Game</title>
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

        <h2>Clicker Game</h2>
        <div class="game">
            <p>Score: <span id="clickCount">0</span></p>
            <button id="clickButton">Click me!</button>
            <button id="resetButton">Reset</button>

            <form id="scoreForm" method="POST" action="submit_score.php">
                <input type="hidden" name="score" id="scoreInput">
                <input type="text" name="player" placeholder="Enter your name" required>
                <button type="submit">Submit Score</button>
                <p id="statusMessage" style="color: green;">
                    <?php if (isset($_GET['submitted'])): ?>
                        You have submitted the score!
                    <?php endif; ?>
                </p>
            </form>

            <p id="statusMessage">
                <?php
                if (isset($_GET['submitted'])) {
                    echo "Score submitted!";
                }
                ?>
            </p>
        </div>
    </div>

    <script>
        let count = 0;
        const clickBtn = document.getElementById('clickButton');
        const resetBtn = document.getElementById('resetButton');
        const countDisplay = document.getElementById('clickCount');
        const scoreInput = document.getElementById('scoreInput');

        clickBtn.addEventListener('click', () => {
            count++;
            countDisplay.textContent = count;
            scoreInput.value = count;
        });

        resetBtn.addEventListener('click', () => {
            count = 0;
            countDisplay.textContent = count;
            scoreInput.value = count;
        });
    </script>
</body>
</html>
