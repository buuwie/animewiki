<?php 

function validateTopic($topic) {
    $errors = array();
    if (empty($topic['name'])) {
        array_push($errors, 'Vui lòng nhập tên thể loại');
    }

    $exisitingTopic = selectOne('topics', ['name' => $topic['name']]);
    if (isset($exisitingTopic)) {
        if (isset($post['update-topic']) && $exisitingTopic['id'] != $topic['id']) {
            array_push($errors, 'Thể loại này đã tồn tại');
        }
        if (isset($post['add-topic'])) {
            array_push($errors, 'Thể loại này đã tồn tại');
        } 
    }

    return $errors;
}

?>