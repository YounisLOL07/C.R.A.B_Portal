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

$login_error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($db_password);
        $stmt->fetch();

        // Basic password check (no hashing)
        if ($password === $db_password) {
            $_SESSION['username'] = $username;
            header("Location: index.php"); // Redirect on success
            exit();
        } else {
            $login_error = "Invalid password.";
        }
    } else {
        $login_error = "User not found.";
    }

    $stmt->close();
}

if (isset($_SESSION['username'])) {
    // If logged in, redirect them to the index page
    header("Location: index.php");
    exit();
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
        <?php if (isset($_SESSION['username'])): ?>
            <span class="logged-in">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="sign_in.php">Sign In</a>
        <?php endif; ?>
        <a href="highscore.php">Highscore</a>
        <a href="FAQ.php">FAQ</a>
    </div>
    <h1>Sign In</h1>
    <div class="left-space">
    <h2>Login to C.R.A.B Portal</h2>
    <?php if ($login_error): ?>
        <p class="error"><?php echo $login_error; ?></p>
    <?php endif; ?>


            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" required />
                <br><br>
                <input type="password" name="password" placeholder="Password" required />
                <br><br>
                <input type="submit" value="Login" />
                <p>Wait, you don't have an account? <a href="register.php">Click here to make one!</a></p>
            </form>
        </div>
    

</body>
</html>
