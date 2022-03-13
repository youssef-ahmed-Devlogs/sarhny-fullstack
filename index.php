<?php

include 'init.php';

if (isset($_SESSION['username'])) {
    header('location: messages.php');
    exit();
}
?>

<main class="login-page section">
    <div class="container">
        <div class="card text-center">
            <div class="card-body">
                <div id="errors"></div>
                <h3 class="card-title mb-4">
                    تسجيل الدخول
                </h3>
                <form id="login" method="POST">
                    <input type="text" name="username" class="form-control mb-3" placeholder="اسم المستخدم">
                    <input type="password" name="pass" class="form-control" placeholder="كلمة المرور">

                    <button class="btn btn-success mt-3">
                        تسجيل الدخول
                        <i class="fas fa-sign-in-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>


<?php include 'inc/App/footer.php'; ?>


<script>
    $(function() {
        $("#login").on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'inc/App/login/check.php',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#errors").html(data)
                }
            })
        })
    })
</script>