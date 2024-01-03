<?php

function validatePost($post) {
    $errors = array();
    if (empty($post['title'])) {
        array_push($errors, 'Vui lòng nhập tiêu đề');
    }

    if (empty($post['body'])) {
        array_push($errors, 'Vui lòng nhập nội dung bài viết');
    }
    
    if (empty($post['topic_id'])) {
        array_push($errors, 'Vui lòng chọn một chủ đề');
    }

    $existingPost = selectOne('posts', ['title' => $post['title']]);
    if (isset($existingPost)) {
        if (isset($post['update-post']) && $existingPost['id'] != $post['id']) {
            array_push($errors, 'Tiêu đề này đã tồn tại');
        }
        if (isset($post['add-post'])) {
            array_push($errors, 'Tiêu đề này đã tồn tại');
        } 
    }

    return $errors;
}

?>