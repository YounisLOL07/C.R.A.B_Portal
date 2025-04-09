<?php
session_start();

$servername = "10.2.2.195";
$username = "younis_admin";
$password = "admin123";
$dbname = "crab_game";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$register_error = '';
$register_success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = trim($_POST['username']);
    $new_password = trim($_POST['password']);
    $new_email = trim($_POST['email']);

    // Check if username already exists
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $new_username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $register_error = "Username already taken.";
    } else {
        // Insert new user
        $insert_stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $insert_stmt->bind_param("sss", $new_username, $new_password, $new_email);

        if ($insert_stmt->execute()) {
            $register_success = "Registration successful! You can now <a href='sign_in.php'>log in</a>.";
        } else {
            $register_error = "Something went wrong. Please try again.";
        }

        $insert_stmt->close();
    }


    $check_stmt->close();

    $check_email_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_email_stmt->bind_param("s", $new_email);
    $check_email_stmt->execute();
    $check_email_stmt->store_result();

    if ($check_email_stmt->num_rows > 0) {
        $register_error = "Email already in use.";
    } else {
        // Insert new user
        $insert_stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $insert_stmt->bind_param("sss", $new_username, $new_password, $new_email);

        if ($insert_stmt->execute()) {
            $register_success = "Registration successful! You can now <a href='sign_in.php'>log in</a>.";
        } else {
            $register_error = "Something went wrong. Please try again.";
        }

        $insert_stmt->close();
    }
    $check_email_stmt->close();
}

$conn->close();
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
        <a href="sign_in.php">Sign In</a>
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
