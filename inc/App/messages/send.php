<?php

include '../../../connect.php';

$uid = trim(filter_var($_POST['uid'], FILTER_SANITIZE_NUMBER_INT));
$message = trim(filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS));

if (empty($message)) {
    echo "<div class='alert alert-danger'>لا يمكن ترك الحقل فارغ.</div>";
} else {


    $stmt = $conn->prepare("INSERT INTO messages(content, user) VALUES(?, ?)");
    $stmt->execute([$message, $uid]);

?>

    <script>
        $(".send-message-page .card").html("<div class='alert alert-success mb-0'>شكرا لصراحتك.</div>");
    </script>

<?php
}
