<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign In</title>
    <style>
        h1{
            display:flex;
            justify-content:center;
            font-family: century-gothic, sans-serif;
        }
        
        .input {
            margin:10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="sign_in.php">Sign In</a>
        <a href="highscore.php">Highscore</a>
        <a href="FAQ.php">FAQ</a>
    </div>
    <h1>Sign In</h1>
    <div class="input">
        <h3>Username: </h3>
        <input type="email" placeholder = "Write your email" required>

        <h3>Email:</h3>
        <input type="email" placeholder = "Write your email" required>

        <h3>Password:</h3>
        <input type="password" placeholder = "Write your password" required>

        <h3>Confirm Password:</h3>
        <input type="password" placeholder = "Confirm your password" required>

        <p>You have an account already? <a href="sign_in.php">Then click here!</a></p>
        <button>Submit</button>
    </div>
    

</body>
</html>
