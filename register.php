<?php
session_start();

require 'db_connect.php';
$conn = dbConnect(); 

$register_error = '';
$register_success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = trim($_POST['username']);
    $new_password = trim($_POST['password']);
    $new_email = trim($_POST['email']);

    try {
        // Hvis brukernavn finnes
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->bindParam(':username', $new_username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $register_error = "Username already taken.";
        } else {
            // Hvis e-post finnes
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->bindParam(':email', $new_email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $register_error = "Email already in use.";
            } else {
                if ($_POST["password"] !== $_POST["confirm_password"]) {
                    $register_error = "You didn't confirm your password!!";
                } else {
                    // Legg til ny bruker
                    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt->bindParam(':username', $new_username);
                    $stmt->bindParam(':password', $hashed_password); 
                    $stmt->bindParam(':email', $new_email);

                    if ($stmt->execute()) {
                        $register_success = "Registration successful! You can now <a href='sign_in.php'>log in</a>.";
                    } else {
                        $register_error = "Something went wrong. Please try again.";
                    }
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
            <input type="password" name="password" placeholder="Choose a password" required minlength="8"/>
            <br><br>
            <input type="password" name="confirm_password" placeholder="Confirm your password" required/>
            <br><br>
            <input type="submit" value="Register" />
            <p>Already have an account? <a href="sign_in.php">Log in here</a></p>
        </form>
    </div>

</body>
</html>
