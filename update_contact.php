<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phonebook";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Get the contact details from the database
    $sql = "SELECT * FROM contacts WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $contact = $result->fetch_assoc();
    } else {
        die("Contact not found.");
    }
}

// Update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    
    // Update the contact in the database
    $update_sql = "UPDATE contacts SET name='$name', phone='$phone', address='$address', email='$email' WHERE id=$id";
    if ($conn->query($update_sql) === TRUE) {
        header("Location: showphonebook.php");
        exit();
    } else {
        echo "Error updating contact: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Contact</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 600px; margin: auto; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h1>Update Contact</h1>
    <form method="POST">
        <input type="text" name="name" value="<?php echo htmlspecialchars($contact['name']); ?>" placeholder="Name" required>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" placeholder="Phone" required>
        <textarea name="address" placeholder="Address" required><?php echo htmlspecialchars($contact['address']); ?></textarea>
        <input type="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" placeholder="Email" required>
        <button type="submit">Update Contact</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
