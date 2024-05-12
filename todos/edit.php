<?php
// Get the task ID and new title from the form submission
$id = $_POST['id'];
$title = $_POST['title'];

require_once "db_conn.php";
// Connect to the database
$conn = new mysqli($sName, $uName, $pass, $db_name);

// Check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement to update the task title
$stmt = $conn->prepare("UPDATE todos SET title=? WHERE id=?");

// Bind the parameters
$stmt->bind_param("si", $title, $id);

// Execute the SQL statement
$stmt->execute();

// Close the statement and the connection
$stmt->close();
$conn->close();

// Redirect back to the main page
header('Location: task.php');
exit;
