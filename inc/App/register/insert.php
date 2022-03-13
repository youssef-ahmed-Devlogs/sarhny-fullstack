<?php

session_start();
include '../../../connect.php';

$username       = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
$email       = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$pass           = $_POST['pass'];
$hashedPass     = MD5($pass);

if (empty($username)) {
    echo "<div class='alert alert-danger'>لا يمكن ترك اسم المستخدم فارغ.</div>";
} elseif (mb_strlen($username, 'utf-8') < 3) {
    echo "<div class='alert alert-danger'>يجب ان يكون اسم المستخدم من ثلاث حروف على الاقل.</div>";
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    echo "<div class='alert alert-danger'>يجب ادخال بريد الكتروني صالح.</div>";
} elseif (mb_strlen($pass, 'utf-8') < 6) {
    echo "<div class='alert alert-danger'>يجب ان تكون كلمة المرور 6 احرف وارقام على الاقل.</div>";
} else {

    // Check if username is exist
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        echo "<div class='alert alert-danger'> اسم المستخدم مسجل بالفعل هل تريد<a href='index.php' class='text-dark'> تسجيل الدخول؟ اضغط هنا</a>.</div>";
    } else {

        $stmt = $conn->prepare("INSERT INTO users(username, email, password) VALUES(:username, :email, :pass)");
        $stmt->execute([
            "username" => $username,
            "email" => $email,
            "pass" => $hashedPass
        ]);
?>
        <script>
            $(".register-page .card").html("<div class='alert alert-success mb-0'>دخول.</div>");
            location = 'messages.php';
        </script>
<?php

    }
}
