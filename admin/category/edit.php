<?php include ("../../path.php");
include (ROOT_PATH . "/app/controllers/topics.php");
adminOnly(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Chỉnh sửa thông tin chủ đề</title>
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
                <a href="create.php" class="btn btn-big">Thêm chủ đề mới</a>
                <a href="index.php" class="btn bn-big">Quản lý chủ đề</a>
            </div>
            <div class="content">
                <h3 class="page-title">Chỉnh sửa thông tin chủ đề</h3>
                <?php include(ROOT_PATH . "/app/helpers/formErrors.php") ?>
                <form action="edit.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>"><br>
                    <div>
                        <label>Tên chủ đề</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="text-input"><br>
                    </div>
                    <div>
                        <label>Mô tả</label>
                        <textarea name="description" id="editor"><?php echo $description; ?></textarea><br>
                    </div>
                    <div>
                        <button type="submit" name="update-topic" class="btn btn-big">Chỉnh sửa</button>
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