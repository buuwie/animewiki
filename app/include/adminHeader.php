<header>
        <a class = "logo" href="<?php echo BASE_URL . '/index.php' ?>">
            <h1 class="logo-text"><span>Anime</span>Wiki</h1>
        </a>
        <i class="fa fa-bars menu-toggle"></i>
        <ul class="nav">
            <?php if (isset($_SESSION['username'])): ?>
                <li>
                <a class="username" href = "#">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['username'] ?>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <ul id="users">
                    <li><a href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Đăng xuất</a></li>
                </ul>
                </li>
            <?php endif; ?>
            
        </ul>
    </header>