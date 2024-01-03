<?php include("path.php");
include (ROOT_PATH . "/app/controllers/posts.php");

if (isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);
}

$posts = getPublishedPosts();
$topics = selectAll('topics');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title'] ?> - AnimeWiki</title>
    <link rel="stylesheet" href="assets/css/single.css">
    <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/54e93fea1b.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--Header-->
    <?php include(ROOT_PATH . "/app/include/header.php"); ?>

    <!--Body page-->
    <div class="page-wrapper">

        <!-- Nội dung page -->

        <div class="content clearfix">
            <div class="main-content single">
                <h3 class="post-title"><?php echo $post['title'] ?></h3>
                <img src="<?php echo BASE_URL . '/assets/images/' .$post['image'] ?>" alt="" class="post-image">
                <div class="post-content">
                    <?php echo html_entity_decode($post['body']) ?>
                </div>
            </div>

            <!--Sidebar-->
            <div class="sidebar single">
                <div class="section search">
                    <h6 class="section-title">Tìm kiếm</h6>
                    <form action="index.php" method="post">
                        <input type="text" name="search-form" class="text-input" placeholder="Tìm kiếm...">
                    </form>
                </div>
                <div class="section recommend-post">
                    <h6 class="section-title">Có thể bạn muốn biết</h6>
                    <?php foreach ($posts as $post): ?>
                    <div class="recommend">
                        <img src="<?php echo BASE_URL . '/assets/images/' . $post['image'] ?>" alt="" class="recommend-image">
                        <div class="recommend-info">
                            <h4><a href="single.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a></h4>
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

    <?php include(ROOT_PATH . "/app/include/footer.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/script.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Philosopher&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
</body>
</html>