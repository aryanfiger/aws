<?php
// config.php

require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

// Create a DynamoDB client instance
$dynamodb = new DynamoDbClient([
    'region'   => 'us-east-1', // Change to your region if needed
    'version'  => 'latest',

]);

// Define your DynamoDB table name
$tableName = 'MyAppTable';
?>
