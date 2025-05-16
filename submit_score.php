<?php
require 'db_connect.php';

$conn = dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $player = htmlspecialchars($_POST['player']);
    $score = intval($_POST['score']);

    $stmt = $conn->prepare("INSERT INTO highscore (player, score) VALUES (?, ?)");
    $stmt->execute([$player, $score]);
    header("Location: clicker_game.php");
    exit();
}
?>
