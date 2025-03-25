<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $conn->real_escape_string($_POST["name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        
        $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
        if ($conn->query($sql)) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}
?>

<?php if ($user): ?>
<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>
    Email: <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
    <input type="submit" value="Update User">
</form>
<?php endif; ?>