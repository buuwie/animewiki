<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$table = 'users';
$adminUsers = selectAll($table);

$id = '';
$username = '';
$email = '';
$admin = '';
$password = '';
$passwordConf = '';
$errors = array();

function userLogin ($user) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = 'Đăng nhập thành công!';
    $_SESSION['type'] = 'success';
    
    if ($_SESSION['admin']) {
        header ('location: ' . BASE_URL . '/admin/posts/index.php');
    }
    else {
        header ('location: ' . BASE_URL . '/index.php');
    }
    exit();
}

if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
    $errors = validateUser($_POST);
    
    if (count($errors) === 0) {
        unset($_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (isset($_POST['admin'])) {
            $_POST['admin'] = 1;
            $user_id = create('users', $_POST);
            $_SESSION['message'] = 'Tạo tài khoản thành công!';
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/admin/users/index.php');
            exit();
        } else {
            $_POST['admin'] = 0;
            $user_id = create('users', $_POST);
            $user = selectOne('users', ['id' => $user_id]);
            
            userLogin($user);
        }
    }
    else {
        $username = $_POST['username'];
        $admin = isset($_POST['admin']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
}

if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
    
    $id = $user['id'];
    $username = $user['username'];
    $admin = $user['admin'] == 1 ? 1 : 0;
    $email = $user['email'];
}

if (isset($_POST['login-btn'])) {
    $errors = login($_POST);

    if (count($errors) === 0) {
        $user = selectOne('users', ['username' => $_POST['username']]);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            userLogin($user);
        }
        else {
            array_push($errors, 'Thông tin đăng nhập không chính xác');
        }          
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $count = delete($table, $_GET['del_id']);
    $_SESSION['message'] = 'Xóa người dùng thành công!';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/users/index.php');
    exit();
}

if (isset($_POST['update-user'])) {
    adminOnly();
    $errors = validateUser($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['passwordConf'], $_POST['update-user'], $_POST['id']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
        $count = update($table, $id, $_POST);
        $_SESSION['message'] = 'Sửa thông tin người dùng thành công!';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/users/index.php');
        exit();
    }
    else {
        $username = $_POST['username'];
        $admin = isset($_POST['admin']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
}

?>