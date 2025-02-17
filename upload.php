<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = uniqid("user_");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['audio']) && isset($_POST['device_model'])) {
    $uploadDir = "uploads/" . $_SESSION['user_id'] . "/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = uniqid("audio_", true) . ".wav";
    $filePath = $uploadDir . $fileName;

    $deviceModel = $_POST['device_model'];
    $logFile = $uploadDir . "device_info.txt";
    file_put_contents($logFile, date("Y-m-d H:i:s") . " - Model: " . $deviceModel . "\n", FILE_APPEND);

    if (move_uploaded_file($_FILES['audio']['tmp_name'], $filePath)) {
        echo json_encode([
            "success" => true,
            "file_url" => $filePath,
            "device_model" => $deviceModel
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "ফাইল আপলোড ব্যর্থ"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "অবৈধ অনুরোধ"]);
}
?>
