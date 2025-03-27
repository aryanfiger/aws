<?php
// edit.php

include 'config.php';

// Check if 'id' is provided in the query string
if (!isset($_GET['id'])) {
    echo "No item selected.";
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    
    try {
        $dynamodb->updateItem([
            'TableName' => $tableName,
            'Key' => [
                'id' => ['S' => $id],
            ],
            'UpdateExpression' => 'set #nm = :n',
            'ExpressionAttributeNames' => ['#nm' => 'name'],
            'ExpressionAttributeValues' => [
                ':n' => ['S' => $name],
            ],
            'ReturnValues' => 'UPDATED_NEW'
        ]);
        header("Location: index.php");
        exit;
    } catch (Aws\Exception\DynamoDbException $e) {
        echo "Unable to update item:<br>" . $e->getMessage();
    }
} else {
    // Fetch the current item details to pre-fill the form
    try {
        $result = $dynamodb->getItem([
            'TableName' => $tableName,
            'Key' => [
                'id' => ['S' => $id],
            ],
        ]);
        if (!isset($result['Item'])) {
            echo "Item not found.";
            exit;
        }
        $name = $result['Item']['name']['S'];
    } catch (Aws\Exception\DynamoDbException $e) {
        echo "Unable to retrieve item:<br>" . $e->getMessage();
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
</head>
<body>
    <h1>Edit Item</h1>
    <form method="post" action="edit.php?id=<?php echo urlencode($id); ?>">
        <label>ID:</label><br>
        <input type="text" value="<?php echo htmlspecialchars($id); ?>" disabled><br>
        <label for="name">Name:</label><br>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>
        <input type="submit" value="Update Item">
    </form>
    <br>
    <a href="index.php">Back to List</a>
</body>
</html>
