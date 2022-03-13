<?php

include 'init.php';


$uid = isset($_GET['uid']) && is_numeric($_GET['uid']) ? intval($_GET['uid']) : 'profile';

if ($uid == 'profile') {

    if (!isset($_SESSION['username'])) {
        header("location: index.php");
        exit();
    }

    $currentUserID = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$currentUserID]);
    $user = $stmt->fetch();

    $stmt = $conn->prepare("SELECT * FROM messages WHERE user = ? ORDER BY date_time DESC");
    $stmt->execute([$currentUserID]);
    $messages = $stmt->fetchAll();
?>

    <main class="messages-page section">
        <div class="container">

            <div id="errors"></div>
            <div class=" row">
                <div class="col-lg-4 mb-3">
                    <div class="card text-center">
                        <div class="card-img">
                            <form id="change-img" method="POST" enctype="multipart/form-data">
                                <label for="profile-img">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file" name="profile-img" id="profile-img" class="d-none">
                            </form>
                            <img src="uploads/<?php echo $user['profile_img'] ?>" class="card-img-top" alt="user profile">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $user['username'] ?>
                            </h5>
                            <p class="card-text">
                                انسخ هذا الرابط وانشره ليصارحك اصدقائك.
                            </p>
                            <div class="d-flex align-items-center gap-2">
                                <span id="copy-text" onclick="copyText()">نسخ</span>
                                <input dir="ltr" type="text" class="form-control text-center" id="link-ref" value="<?Php echo $_SERVER['HTTP_HOST'] . '/sarhny/messages.php?uid=' . $_SESSION['id'] ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card messages-card">
                        <div class="card-header text-center">
                            <span>
                                الرسائل
                                <i class="fas fa-envelope"></i>
                            </span>
                            <span>
                                <?php echo count($messages) ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <?php foreach ($messages as $msg) { ?>
                                <div class="date d-flex justify-content-end"><?php echo $msg['date_time'] ?></div>
                                <p class="card-text bg-light mb-3 p-3 rounded border">
                                    <?php echo $msg['content'] ?>
                                </p>
                            <?php } ?>

                            <?php if (count($messages) <= 0) { ?>
                                <span>لا يوجد رسائل حتى الان.</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php include 'inc/App/footer.php'; ?>

    <script>
        $(function() {
            $("#profile-img").on('change', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'inc/App/user-profile/change-img.php',
                    data: new FormData(this.form),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#errors").html(data);
                    }
                })
            })
        })
    </script>


    <script>
        function copyText() {
            /* Get the text field */
            var linkRef = document.getElementById("link-ref");

            /* Select the text field */
            linkRef.select();
            linkRef.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(linkRef.value);
        }
    </script>

    <?php


} elseif ($uid > 0) {


    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->execute([$uid]);

    if ($stmt->rowCount() > 0) {

    ?>

        <main class="send-message-page section">
            <div class="container">
                <div class="card text-center">
                    <div class="card-body">
                        <div id="errors"></div>
                        <h3 class="card-title mb-4">
                            صارح صديقك
                        </h3>
                        <form id="send-message" method="POST">
                            <input type="hidden" name="uid" value="<?php echo $uid ?>">
                            <textarea name="message" id="message" class="form-control" placeholder="انت رائع..."></textarea>
                            <button class="btn btn-success mt-3">صارح</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <?php include 'inc/App/footer.php'; ?>

        <script>
            $(function() {
                $("#send-message").on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: 'inc/App/messages/send.php',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $("#errors").html(data);
                        }
                    })
                })
            })
        </script>

<?php

    } else {
        header("location: index.php");
        exit();
    }
} else {
    header("location: index.php");
    exit();
}
