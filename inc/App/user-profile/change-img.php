<?php

session_start();
include '../../../connect.php';

$img = $_FILES['profile-img'];
$imgName    = $img['name'];
$imgSize    = $img['size'];
$imgType    = $img['type'];
$imgTmpName = $img['tmp_name'];


$validSize = (1024 * 5) * 1024;
$Extentions = ['png', 'jpg', 'jpeg'];

$imgExtention = explode('/', $imgType);
$imgExtention = end($imgExtention);

$imgName = rand(0, 9999999) . $imgName;

if (!in_array($imgExtention, $Extentions)) {
    echo "<div class='alert alert-danger'>يجب ان تكون الصورة من نوع (png, jpg, jpeg)</div>";
} elseif ($imgSize > $validSize) {
    echo "<div class='alert alert-danger'>يجب ان يكون حجم الصورة اصغر من 5 ميجا.</div>";
} else {
    $stmt = $conn->prepare("UPDATE users SET profile_img = ? WHERE id = ?");
    $stmt->execute([$imgName, $_SESSION['id']]);

    if ($stmt->rowCount() > 0) {
        move_uploaded_file($imgTmpName, '../../../uploads/' . $imgName);

?>

        <script>
            location.reload();
        </script>

<?php
    }
}
