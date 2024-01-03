<?php 
include ("../../path.php");
include (ROOT_PATH . "/app/controllers/posts.php");
adminOnly();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Thêm bài viết mới</title>
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
                <h3 class="page-title">Tạo bài viết mới</h3>

                <?php include (ROOT_PATH . "/app/helpers/formErrors.php") ?>

                <form action="create.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label>Tiêu đề</label>
                        <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                    </div>
                    <div>
                        <label>Nội dung</label>
                        <textarea name="body" id="editor"><?php echo $body ?></textarea>
                    </div>
                    <div>
                        <label>Image</label>
                        <input type="file" name="image" class="text-input">
                    </div>
                    <div>
                        <label>Chủ đề</label>
                        <select name="topic_id" class="text-input">
                            <option value=""></option>
                            <?php foreach ($topics as $key => $topic): ?>
                                <?php if (!empty($topic_id) && $topic_id == $topic['id']): ?>
                                    <option selected value="<?php echo $topic['id']; ?>"><?php echo $topic['name'] ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $topic['id']; ?>"><?php echo $topic['name'] ?></option>
                            <?php endif; endforeach ?>
                        </select>
                    </div>
                    <div>
                        <?php if (empty($published)): ?>
                        <label>
                            <input type="checkbox" name="published">Xuất bản
                        </label>
                        <?php else: ?>
                        <label>
                            <input type="checkbox" name="published" checked>Xuất bản
                        </label>
                        <?php endif ?>
                    </div>
                    <div>
                        <button type="submit" name="add-post" class="btn btn-big">Tạo bài viết</button>
                    </div>
                </form>
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