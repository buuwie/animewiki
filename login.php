<?php 
include("path.php");
include(ROOT_PATH . "/app/controllers/users.php");
guestOnly(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - AnimeWiki</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Philosopher&display=swap" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/54e93fea1b.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--Header-->
    <?php include(ROOT_PATH . "/app/include/header.php"); ?>

    <div class="auth-content">
        <form action="login.php" method="post">
            <h2 class="form-title">Đăng nhập</h2>

            <?php include(ROOT_PATH . "/app/helpers/formErrors.php") ?>
            
            <div>
                <label>Tên đăng nhập</label>
                <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
            </div>
            <div>
                <label>Mật khẩu</label>
                <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
            </div>
            <div>
                <button type="submit" name="login-btn" class="btn btn-big">Đăng nhập</button>
            </div>
            <p>Chưa có tài khoản? <a href="<?php echo BASE_URL . '/register.php' ?>">Đăng kí</a> ngay</p>
        </form>   
    </div>
    <!--Body page-->
    
    <?php include(ROOT_PATH . "/app/include/footer.php") ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/script.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
</body>
</html>