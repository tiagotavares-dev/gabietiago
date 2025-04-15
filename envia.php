
<?php
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = basename($file["name"]);
    $targetFilePath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov'];
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            header("Location: index.php?sucesso=1");
            exit();
        } else {
            header("Location: index.php?erro=1");
            exit();
        }
    } else {
        header("Location: index.php?erro=2");
        exit();
    }
} else {
    header("Location: index.php?erro=3");
    exit();
}
?>
