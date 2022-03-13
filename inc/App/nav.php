<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">صارحني</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['username'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="messages.php">
                            رسائلي
                            <i class="fas fa-envelope"></i>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            تسجيل الخروج
                            <i class="fas fa-door-closed"></i>
                        </a>
                    </li>

                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            تسجيل الدخول
                            <i class="fas fa-door-open"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">
                            انشاء حساب
                            <i class="fas fa-plus"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>