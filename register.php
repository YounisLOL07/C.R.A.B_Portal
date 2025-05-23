<?php
session_start();

require 'db_connect.php';
$conn = dbConnect(); // Make sure this returns a PDO instance

$register_error = '';
$register_success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = trim($_POST['username']);
    $new_password = trim($_POST['password']);
    $new_email = trim($_POST['email']);

    try {
        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->bindParam(':username', $new_username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $register_error = "Username already taken.";
        } else {
            // Check if email exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->bindParam(':email', $new_email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $register_error = "Email already in use.";
            } else {
                // Insert new user
                $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
                $stmt->bindParam(':username', $new_username);
                $stmt->bindParam(':password', $new_password); //Jeg skal hashe passordet senere.
                $stmt->bindParam(':email', $new_email);

                if ($stmt->execute()) {
                    $register_success = "Registration successful! You can now <a href='sign_in.php'>log in</a>.";
                } else {
                    $register_error = "Something went wrong. Please try again.";
                }
            }
        }
    } catch (PDOException $e) {
        $register_error = "Database error: " . $e->getMessage();
    }
}
?>



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


        .left-space {
            margin-left:20px;
        }
    </style>
</head>
<body>
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
    <h1>Register</h1>
    <div class="left-space">
        <h2>Create a C.R.A.B Account</h2>

        <?php if ($register_error): ?>
            <p class="error"><?php echo $register_error; ?></p>
        <?php endif; ?>

        <?php if ($register_success): ?>
            <p class="success"><?php echo $register_success; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Choose a username" required />
            <br><br>
            <input type="email" name="email" placeholder="Your email address" required />
            <br><br>
            <input type="password" name="password" placeholder="Choose a password" required />
            <br><br>
            <input type="submit" value="Register" />
            <p>Already have an account? <a href="sign_in.php">Log in here</a></p>
        </form>
    </div>

</body>
</html>
