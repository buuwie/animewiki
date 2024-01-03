<?php

function userOnly($redirect = '/index.php') {
    if (empty($_SESSION['id'])) {
        $_SESSION['message'] = 'Bạn cần đăng nhập trước!';
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . $redirect);
        exit();
    }
}

function adminOnly($redirect = '/index.php') {
    if (empty($_SESSION['id']) || empty($_SESSION['admin'])) {
        $_SESSION['message'] = 'Bạn chưa được ủy quyền!';
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . $redirect);
        exit();
    }
}


function guestOnly ($redirect = '/index.php') {
    if (isset($_SESSION['id'])) {
        header('location: ' . BASE_URL . $redirect);
        exit();
    }
}