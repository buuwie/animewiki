<?php include ("../../path.php");
include (ROOT_PATH . "/app/controllers/posts.php");
adminOnly();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản lý bài viết</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Philosopher&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/54e93fea1b.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--Header-->
    <?php include(ROOT_PATH . "/app/include/adminHeader.php") ?>

    <!--Body page-->
    <div class="admin-wrapper">

        <!--cột trái-->
        <?php include (ROOT_PATH . "/app/include/adminSidebar.php") ?>

        <!--cột phải-->
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn btn-big">Tạo bài viết mới</a>
                <a href="index.php" class="btn bn-big">Quản lý bài viết</a>
            </div>
            <div class="content">
                <h3 class="page-title">Quản lý bài viết</h3>

                <?php include (ROOT_PATH . "/app/include/messages.php") ?>

                <table>
                    <thead>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Người viết</th>
                        <th colspan="3">Tác vụ</th>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $key => $post):
                            $author = getAuthor($post['user_id']); ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $post['title'] ?></td>
                            <?php foreach ($author as $num => $writer): ?>
                                <td><?php echo $writer['username'] ?></td>
                            <?php endforeach ?>
                            <td><a href="edit.php?id=<?php echo $post['id'] ?>" class="edit">Chỉnh sửa</a></td>
                            <td><a href="edit.php?del_id=<?php echo $post['id'] ?>" class="delete">Xóa</a></td>
                            <?php if ($post['published']): ?>
                                <td><a href="edit.php?published=0&p_id=<?php echo $post['id'] ?>" class="unpublish">Hủy xuất bản</a></td>
                            <?php else: ?>
                                <td><a href="edit.php?published=1&p_id=<?php echo $post['id'] ?>" class="publish">Xuất bản</a></td>
                            <?php endif ?>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../../assets/js/script.js"></script>
    <script src="../../assets/js/ckeditor.js"></script>
    <script>
        ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
        console.log( error );
    } );
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
</body>
</html>