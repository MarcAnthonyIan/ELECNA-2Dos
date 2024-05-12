<?php

if (isset($_POST['title'])) {
    require 'db_conn.php';

    $title = $_POST['title'];
    $category = $_POST['category'];

    if (empty($title) || empty($category)) {
        header("Location: task.php?mess=error");
    } else {
        $stmt = $conn->prepare("INSERT INTO todos(title, category) VALUE(?, ?)");
        $res = $stmt->execute([$title, $category]);

        if ($res) {
            header("Location: task.php?mess=success");
        } else {
            header("Location: task.php");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: task.php?mess=error");
}
