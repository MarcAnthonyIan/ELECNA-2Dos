<?php

if (isset($_POST['id']) && isset($_POST['checked'])) {
    require 'db_conn.php';

    $id = $_POST['id'];
    $checked = $_POST['checked'] ? 1 : 0;

    $stmt = $conn->prepare("UPDATE todos SET checked = :checked WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':checked', $checked, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo $checked;
    } else {
        http_response_code(500);
        echo 'Error: Unable to update todo';
    }
    exit();
} else {
    http_response_code(400);
    echo 'Error: Invalid request';
    exit();
}
