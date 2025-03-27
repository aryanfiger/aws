<?php
// index.php

include 'config.php';

// Retrieve all items from the DynamoDB table
try {
    $result = $dynamodb->scan([
        'TableName' => $tableName
    ]);
} catch (Aws\Exception\DynamoDbException $e) {
    echo "Unable to scan table:<br>" . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My App - List Items</title>
</head>
<body>
    <h1>Items List</h1>
    <a href="add.php">Add New Item</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php
        if (isset($result['Items'])) {
            foreach ($result['Items'] as $item) {
                // Assuming each item has an 'id' and 'name' attribute
                $id = $item['id']['S'];
                $name = $item['name']['S'];
                echo "<tr>";
                echo "<td>" . htmlspecialchars($id) . "</td>";
                echo "<td>" . htmlspecialchars($name) . "</td>";
                echo "<td><a href='edit.php?id=" . urlencode($id) . "'>Edit</a> | <a href='delete.php?id=" . urlencode($id) . "'>Delete</a></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>
