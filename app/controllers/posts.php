<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$table = 'posts';
$topics = selectAll('topics');
$posts = selectAll($table);

$errors = array();
$id = "";
$title = "";
$body = "";
$topic_id = "";
$user_id = "";
$published = "";

if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);
    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $topic_id = $post['topic_id'];
    $user_id = $post['user_id'];
    $published = $post['published'];
}

if (isset($_GET['del_id'])) {
    $count = delete($table, $_GET['del_id']);
    $_SESSION['message'] = 'Xóa bài viết thành công!';
    $_SESSION['type'] = 'success';

    header ('location: ' . BASE_URL . '/admin/posts/index.php');
    exit();
}

if (isset($_GET['published']) && isset($_GET['p_id'])) {
    adminOnly();
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];
    $count = update($table, $p_id, ['published' => $published]);

    $_SESSION['message'] = 'Đã thay đổi trạng thái bài viết!';
    $_SESSION['type'] = 'success';

    header ('location: ' . BASE_URL . '/admin/posts/index.php');
    exit();
}

if (isset($_POST['add-post'])) {
    adminOnly();
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $des = ROOT_PATH . "/assets/images/" . $image_name;
        
        $rs = move_uploaded_file($_FILES['image']['tmp_name'], $des);
        if ($rs) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Load ảnh thất bại!");
        }
        
    } else {
        array_push($errors, "Vui lòng thêm ảnh");
    }
    

    if (count($errors) === 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);

        $post_id = create($table, $_POST);
        $_SESSION['message'] = 'Tạo bài viết thành công!';
        $_SESSION['type'] = 'success';

        header ('location: ' . BASE_URL . '/admin/posts/index.php');
        exit();
    }
    else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
}

if (isset($_POST['update-post'])) {
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $des = ROOT_PATH . "/assets/images/" . $image_name;
        
        $rs = move_uploaded_file($_FILES['image']['tmp_name'], $des);
        if ($rs) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Load ảnh thất bại!");
        }
        
    } else {
        array_push($errors, "Vui lòng thêm ảnh");
    }
    

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);

        $post_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Sửa bài viết thành công!';
        $_SESSION['type'] = 'success';

        header ('location: ' . BASE_URL . '/admin/posts/index.php');
        exit();
    }
    else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
}

if (isset($_POST['member-add-post'])) {
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $des = ROOT_PATH . "/assets/images/" . $image_name;
        
        $rs = move_uploaded_file($_FILES['image']['tmp_name'], $des);
        if ($rs) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Load ảnh thất bại!");
        }
        
    } else {
        array_push($errors, "Vui lòng thêm ảnh");
    }
    

    if (count($errors) === 0) {
        unset($_POST['member-add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['body'] = htmlentities($_POST['body']);

        $post_id = create($table, $_POST);
        $_SESSION['message'] = 'Tạo bài viết thành công!';
        $_SESSION['type'] = 'success';

        header ('location: ' . BASE_URL . '/member/index.php');
        exit();
    }
    else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
    }
}

if (isset($_POST['member-update-post'])) {
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $des = ROOT_PATH . "/assets/images/" . $image_name;
        
        $rs = move_uploaded_file($_FILES['image']['tmp_name'], $des);
        if ($rs) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Load ảnh thất bại!");
        }
        
    } else {
        array_push($errors, "Vui lòng thêm ảnh");
    }
    

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['member-update-post'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);

        $post_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Sửa bài viết thành công!';
        $_SESSION['type'] = 'success';

        header ('location: ' . BASE_URL . '/member/index.php');
        exit();
    }
    else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
}

if (isset($_GET['member_del_id'])) {
    $count = delete($table, $_GET['member_del_id']);
    $_SESSION['message'] = 'Xóa bài viết thành công!';
    $_SESSION['type'] = 'success';

    header ('location: ' . BASE_URL . '/member/index.php');
    exit();
}