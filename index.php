<?php 
include("path.php");
include (ROOT_PATH . "/app/controllers/topics.php");

$posts = array();
$postsTitle = 'Bài viết mới nhất';
$title = 'Trang chủ - AnimeWiki';


if (isset($_GET['t_id'])) {
    $posts = getPostsByTopic($_GET['t_id']);
    $postsTitle = "Chủ đề: " . $_GET['name'];
    $title = $_GET['name'] . " - AnimeWiki";
}
else if (isset($_POST['search-term'])) {
    $postsTitle = "Kết quả tìm kiếm với: '" . $_POST['search-term'] . "' ";
    $posts = searchPosts($_POST['search-term']);
    $title = "Kết quả tìm kiếm với: '" . $_POST['search-term'] . "' - AnimeWiki";
}
else {
    $posts = getPublishedPosts();
}
$recommendPosts = getPublishedPosts();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Philosopher&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/54e93fea1b.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--Header-->
    <?php include(ROOT_PATH . "/app/include/header.php"); ?>

    <?php include(ROOT_PATH . "/app/include/messages.php"); ?>

    <!--Body page-->
    <div class="page-wrapper">

        <!-- Slider bài viết -->

        <div class="post-slider">
            <h1 class="slider-title">Bài viết thịnh hành</h1>
            <i class="fas fa-chevron-left prev"></i>
            <i class="fas fa-chevron-right next"></i>
            <div class="post-wrapper">
                <?php foreach ($posts as $post): ?>
                <div class="slider-post">
                    <img src="<?php echo BASE_URL . '/assets/images/' . $post['image'] ?>" alt="" class="slider-image">
                    <div class="post-info">
                        <h4><a href="single.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a></h4>
                        <i class="far fa-user"> <?php echo $post['username'] ?></i>
                        &nbsp;
                        <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($post['time_created'])) ?></i>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>

        <!-- Nội dung page -->

        <div class="content clearfix">
            <div class="main-content">
                <h1 class="recent-post-title"><?php echo $postsTitle ?></h1>
                <?php foreach ($posts as $post): ?>
                <div class="post">
                    <img src="<?php echo BASE_URL . '/assets/images/' . $post['image'] ?>" alt="" class="post-image">
                    <div class="post-preview">
                        <h3><a href="single.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a></h3>
                        <i class="far fa-user"> <?php echo $post['username'] ?></i>
                        &nbsp;
                        <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($post['time_created'])) ?></i>
                        <p class="preview-text">
                            <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...') ?>
                        </p>
                        <a href="single.php?id=<?php echo $post['id'] ?>" class="btn read-more">Đọc thêm</a>
                    </div>
                </div>
                <?php endforeach ?>
            </div>

            <!--Sidebar-->
            <div class="sidebar">
                <div class="section search">
                    <h6 class="section-title">Tìm kiếm</h6>
                    <form action="index.php" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="Tìm kiếm...">
                    </form>
                </div>
                <div class="section recommend-post">
                    <h6 class="section-title">Có thể bạn muốn biết</h6>
                    <?php foreach ($recommendPosts as $pst): ?>
                    <div class="recommend">
                        <img src="<?php echo BASE_URL . '/assets/images/' . $pst['image'] ?>" alt="" class="recommend-image">
                        <div class="recommend-info">
                            <h4><a href="single.php?id=<?php echo $pst['id'] ?>"><?php echo $pst['title'] ?></a></h4>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <div class="section topics">
                    <h6 class="section-title">Chủ đề</h6>
                    <ul>
                        <?php foreach ($topics as $key => $topic): ?>
                            <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>    
    
    <?php include(ROOT_PATH . "/app/include/footer.php") ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/script.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
</body>
</html>