<?php 

function validateUser($user) {
    $errors = array();
    if (empty($user['username'])) {
        array_push($errors, 'Vui lòng nhập tên người dùng');
    }

    if (empty($user['email'])) {
        array_push($errors, 'Vui lòng nhập email');
    }
    
    if (empty($user['password'])) {
        array_push($errors, 'Vui lòng nhập mật khẩu');
    }

    if ($user['passwordConf'] !== $user['password']) {
        array_push($errors, 'Mật khẩu phải giống nhau');
    }

    $existingUsername = selectOne('users', ['username' => $user['username']]);
    if (isset($existingUsername)) {
        if (isset($user['update-user']) && $existingUsername['id'] != $user['id']) {
            array_push($errors, 'Tên người dùng này đã được sử dụng');
        }
        if (isset($user['create-admin']) || isset($user['register-btn'])) {
            array_push($errors, 'Tên người dùng này đã được sử dụng');
        } 
    }

    $existingEmail = selectOne('users', ['email' => $user['email']]);
    if (isset($existingEmail)) {
        if (isset($user['update-user']) && $existingEmail['id'] != $user['id']) {
            array_push($errors, 'Email này đã được sử dụng');
        }
        if (isset($user['create-admin']) || isset($user['register-btn'])) {
            array_push($errors, 'Email này đã được sử dụng');
        } 
    }

    return $errors;
}


function login($user) {
    $errors = array();
    if (empty($user['username'])) {
        array_push($errors, 'Vui lòng nhập tên người dùng');
    }
    
    if (empty($user['password'])) {
        array_push($errors, 'Vui lòng nhập mật khẩu');
    }

    return $errors;
}
?>