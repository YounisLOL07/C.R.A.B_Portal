<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Clicker Game</title>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="index.php">Home</a>
            <a href="sign_in.php">Sign In</a>
            <a href="highscore.php">Highscore</a>
            <a href="FAQ.php">FAQ</a>
        </div>

        <h3>Clicker Game</h3>

        <div class="games">
            <div class="clickerGame">
                <button id="clickButton">Click me</button>
                <button id="startOverButton">Start over</button>
                <button id="ten">10X</button>

                <p>Button clicked: <span id="clickCount">0</span> times</p>

            </div>

        </div>

    </div>
    <script src="script.js"></script>
</body>
</html>
