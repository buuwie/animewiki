<?php 
include("../path.php");
include (ROOT_PATH . "/app/controllers/topics.php");

$posts = array();
$memberPosts = array();

if (isset($_GET['t_id'])) {
    $posts = getPostsByTopic($_GET['t_id']);
    $postsTitle = "Chủ đề: " . $_GET['name'];
}
else if (isset($_POST['search-term'])) {
    $postsTitle = "Kết quả tìm kiếm với: '" . $_POST['search-term'] . "' ";
    $posts = searchPosts($_POST['search-term']);
}
else {
    $posts = getPublishedPosts();
}
$recommendPosts = getPublishedPosts();

if (isset($_SESSION['id'])) {
    $memberPosts = postsById($_SESSION['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài viết của tôi - AnimeWiki</title>
    <link rel="stylesheet" href="../assets/css/member.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
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

        <!-- Nội dung page -->

        <div class="content clearfix">
            <div class="main-content">

            <div class="button-group">
                <h3 class="page-title">Bài viết của tôi</h3><br>
                <?php if ($_SESSION['admin']): ?>
                <a href="<?php echo BASE_URL . "/admin/posts/create.php" ?>" class="btn btn-big">Tạo bài viết mới</a>
                    <?php else: ?>
                <a href="create.php" class="btn btn-big">Tạo bài viết mới</a>
                <?php endif; ?>
                <a href="index.php?u_id=<?php echo $_SESSION['id'] ?>" class="btn bn-big">Bài viết của tôi</a>
            </div>
            <div class="content">

                <table>
                    <thead>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th colspan="2">Tác vụ</th>
                    </thead>
                    <tbody>
                        <?php foreach ($memberPosts as $key => $post):?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $post['title'] ?></td>
                            <?php if ($post['published']): ?>
                                <td>Đã xuất bản</a></td>
                            <?php else: ?>
                                <td>Chưa xuất bản</a></td>
                            <?php endif ?>
                            <td><a href="edit.php?id=<?php echo $post['id'] ?>" class="edit">Chỉnh sửa</a></td>
                            <td><a href="edit.php?member_del_id=<?php echo $post['id'] ?>" class="delete">Xóa</a></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            </div>

            <!--Sidebar-->
            <div class="sidebar">
                <div class="section search">
                    <h6 class="section-title">Tìm kiếm</h6>
                    <form action="<?php echo BASE_URL . '/index.php' ?>" method="post">
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