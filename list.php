<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit();
}

$dir = "uploads/" . $_SESSION['user_id'] . "/";
$files = glob($dir . "*.wav");

echo json_encode($files);
?>
