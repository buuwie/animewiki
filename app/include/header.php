<header>
    <a href="<?php echo BASE_URL . '/index.php' ?>" class = "logo">
        <h1 class="logo-text"><span>Anime</span>Wiki</h1>
    </a>
    <i class="fa fa-bars menu-toggle"></i>
    <ul class="nav">
        <li><a href = "<?php echo BASE_URL . '/index.php' ?>">Trang chủ</a></li>
        <li><a href = "<?php echo BASE_URL . '/index.php?t_id=8&name=Nhân%20vật' ?>">Nhân vật</a></li>
        <li><a href = "<?php echo BASE_URL . '/index.php?t_id=9&name=Tin%20tức' ?>">Tin tức</a></li>
        <li><a href = "<?php echo BASE_URL . '/info.php' ?>">Giới thiệu</a></li>

        <?php if (isset($_SESSION['id'])): ?>
        <li>
            <a class="username" href = "#">
                <i class="fa fa-user"></i>
                <?php echo $_SESSION['username']; ?>
                <i class="fa fa-chevron-down"></i>
            </a>
            <ul id="users">
                <?php if($_SESSION['admin']): ?>
                <li><a href="<?php echo BASE_URL . '/admin/posts/index.php' ?>">Trang điều khiển</a></li>
                <?php endif; ?>
                <li><a href="<?php echo BASE_URL . '/member/index.php?u_id=' . $_SESSION['id'] ?>">Bài viết của tôi</a></li>
                <?php if($_SESSION['admin']): ?>
                <li><a href="<?php echo BASE_URL . '/admin/posts/create.php' ?>">Tạo bài viết mới</a></li>
                <?php else: ?>
                <li><a href="<?php echo BASE_URL . '/member/create.php' ?>">Tạo bài viết mới</a></li>
                <?php endif; ?>
                <li><a href="<?php echo BASE_URL . '/logout.php' ?>">Đăng xuất</a></li>
            </ul>
        </li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL . '/login.php' ?>">Đăng nhập</a></li>
            <li><a href="<?php echo BASE_URL . '/register.php' ?>">Đăng kí</a></li>
        <?php endif; ?>
    </ul>
</header>