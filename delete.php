<?php
// delete.php

include 'config.php';

if (!isset($_GET['id'])) {
    echo "No item selected.";
    exit;
}

$id = $_GET['id'];

try {
    $dynamodb->deleteItem([
        'TableName' => $tableName,
        'Key' => [
            'id' => ['S' => $id],
        ],
    ]);
    header("Location: index.php");
    exit;
} catch (Aws\Exception\DynamoDbException $e) {
    echo "Unable to delete item:<br>" . $e->getMessage();
}
?>
