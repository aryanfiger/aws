<?php
// add.php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    
    try {
        $dynamodb->putItem([
            'TableName' => $tableName,
            'Item' => [
                'id'   => ['S' => $id],
                'name' => ['S' => $name],
            ]
        ]);
        header("Location: index.php");
        exit;
    } catch (Aws\Exception\DynamoDbException $e) {
        echo "Unable to add item:<br>" . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
</head>
<body>
    <h1>Add New Item</h1>
    <form method="post" action="add.php">
        <label for="id">ID:</label><br>
        <input type="text" name="id" id="id" required><br>
        <label for="name">Name:</label><br>
        <input type="text" name="name" id="name" required><br><br>
        <input type="submit" value="Add Item">
    </form>
    <br>
    <a href="index.php">Back to List</a>
</body>
</html>
