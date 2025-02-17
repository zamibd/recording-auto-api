<?php
$dir = "uploads/";
$files = glob($dir . "*.wav");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Audio list</title>
</head>
<body>
    <h2>save audio</h2>
    <ul>
        <?php foreach ($files as $file): ?>
            <li>
                <audio controls>
                    <source src="<?php echo $file; ?>" type="audio/wav">
                </audio>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
