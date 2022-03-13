<?php

include 'init.php';

if (isset($_SESSION['username'])) {
    header('location: messages.php');
    exit();
}

?>

<main class="register-page section">
    <div class="container">
        <div class="card text-center">
            <div class="card-body">
                <div id="errors"></div>
                <h3 class="card-title mb-4">
                    انشاء حساب جديد
                </h3>
                <form id="register" method="POST">
                    <input type="text" name="username" class="form-control mb-3" placeholder="اسم المستخدم">
                    <input type="text" name="email" class="form-control mb-3" placeholder="البريد الالكتروني">
                    <input type="password" name="pass" class="form-control" placeholder="كلمة المرور">

                    <button class="btn btn-success mt-3">
                        انشاء الحساب
                        <i class="fas fa-plus"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>


<?php include 'inc/App/footer.php'; ?>


<script>
    $(function() {
        $("#register").on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'inc/App/register/insert.php',
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