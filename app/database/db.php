<?php

session_start();
require('connect.php');

function dd($value) {
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}

function executeQuery ($sql, $data)
{
    global $conn;
    $cmd = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $cmd->bind_param($types, ...$values);
    $cmd->execute();
    return $cmd;
}

function selectAll($table, $conditions = []) {
    global $conn;
    $sql = "select * from $table";
    if (empty($conditions)) {
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        $result = $cmd->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    else {
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " where $key=?";
            }
            else {
                $sql = $sql . " and $key=?";
            }
            $i++;
        }

        $cmd = executeQuery($sql, $conditions);
        $result = $cmd->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}

function selectOne($table, $conditions = []) {
    global $conn;
    $sql = "select * from $table";
    $i = 0;
    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " where $key=?";
        }
        else {
            $sql = $sql . " and $key=?";
        }
        $i++;
    }

    $sql = $sql . " limit 1";

    $cmd = executeQuery($sql, $conditions);
    $result = $cmd->get_result()->fetch_assoc();
    return $result;
}

function create ($table, $data) {
    global $conn;
    $sql = "insert into $table set ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        }
        else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    $cmd = executeQuery($sql, $data);
    $id = $cmd->insert_id;
    return $id;
}

function update ($table, $id, $data) {
    global $conn;
    $sql = "update $table set ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        }
        else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " where id=?";
    $data['id'] = $id;
    $cmd = executeQuery($sql, $data);
    return $cmd->affected_rows;
}

function delete ($table, $id) {
    global $conn;
    $sql = "delete from $table where id=? ";
    $cmd = executeQuery($sql, ['id' => $id]);
    return $cmd->affected_rows;
}

function getPublishedPosts ()
{
    global $conn;
    $sql = "select p.*, u.username from posts as p join users as u on p.user_id=u.id where published=? order by p.time_created desc";
    $cmd = executeQuery($sql, ['published' => 1]);
    $result = $cmd->get_result()->fetch_all(MYSQLI_ASSOC);
    return $result;
}

function searchPosts ($term)
{
    $match = '%' . $term . '%';
    global $conn;
    $sql = "select p.*, u.username from posts as p join users as u on p.user_id=u.id where published=?
    and p.title like ? or p.body like ? order by p.time_created desc";
    $cmd = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
    $result = $cmd->get_result()->fetch_all(MYSQLI_ASSOC);
    return $result;
}

function getPostsByTopic ($topic_id)
{
    global $conn;
    $sql = "select p.*, u.username from posts as p join users as u on p.user_id=u.id where published=? and topic_id=? order by p.time_created desc";
    $cmd = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
    $result = $cmd->get_result()->fetch_all(MYSQLI_ASSOC);
    return $result;
}

function getAuthor ($user_id) {
    global $conn;
    $sql = "select * from users where id=?";
    $cmd = executeQuery($sql, ['id' => $user_id]);
    $rs = $cmd->get_result()->fetch_all(MYSQLI_ASSOC);
    return $rs;
}

function postsById ($user_id) {
    global $conn;
    $sql = "select * from posts where user_id=?";
    $cmd = executeQuery($sql, ['user_id' => $user_id]);
    $rs = $cmd->get_result()->fetch_all(MYSQLI_ASSOC);
    return $rs;
}