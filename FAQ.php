<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>FAQ</title>
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

    <h1>FAQ</h1>

    <div class="faq-container">
        <div class="faq-item">
            <h2>Hvordan registrerer jeg meg?</h2>
            <p>Gå til <code>register.php</code> og fyll ut brukernavn, e-post og passord. Passord må være minst 8 tegn.</p>
        </div>
        <div class="faq-item">
            <h2>Hvordan logger jeg inn?</h2>
            <p>Bruk <code>sign_in.php</code> og skriv inn brukernavn og passord.</p>
        </div>
        <div class="faq-item">
            <h2>Hvordan fungerer Clicker Game?</h2>
            <p>Du klikker på knappen "Click me!" for å øke poengsummen. Når du er ferdig, kan du skrive inn navnet ditt og sende inn poengsummen til highscore-listen.</p>
        </div>
        <div class="faq-item">
            <h2>Hvor lagres poengene?</h2>
            <p>Poengene lagres i databasen i tabellen <code>highscore</code> sammen med navnet du oppgir.</p>
        </div>
        <div class="faq-item">
            <h2>Hva skjer hvis jeg logger ut?</h2>
            <p>Sessionen din slettes og du må logge inn igjen for å få tilgang til brukerfunksjoner.</p>
        </div>
    </div>

</body>
</html>