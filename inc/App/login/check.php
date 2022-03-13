<?php

session_start();
include '../../../connect.php';

$username       = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
$pass           = $_POST['pass'];
$hashedPass     = MD5($pass);

if (empty($username)) {
    echo "<div class='alert alert-danger'>لا يمكن ترك اسم المستخدم فارغ.</div>";
} elseif (mb_strlen($username, 'utf-8') < 3) {
    echo "<div class='alert alert-danger'>يجب ان يكون اسم المستخدم من ثلاث حروف على الاقل.</div>";
} elseif (mb_strlen($pass, 'utf-8') < 6) {
    echo "<div class='alert alert-danger'>يجب ان تكون كلمة المرور 6 احرف وارقام على الاقل.</div>";
} else {

    // Check if username is exist
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() <= 0) {
        echo "<div class='alert alert-danger'> اسم المستخدم غير مسجل هل تريد<a href='register.php' class='text-dark'> تسجيل حساب جديد؟ اضغط هنا</a>.</div>";
    } else {
        // Check if username is exist
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$username, $hashedPass]);
        $user = $stmt->fetch();

        if ($stmt->rowCount() <= 0) {
            echo "<div class='alert alert-danger'>كلمة السر غير صحيحة.</div>";
        } else {

            $_SESSION['username'] = $user['username'];
            $_SESSION['id'] = $user['id'];
?>

            <script>
                $(".login-page .card").html("<div class='alert alert-success mb-0'>دخول.</div>");
                location = 'messages.php';
            </script>
<?php
        }
    }
}
