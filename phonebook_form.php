<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phonebook";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $position = $_POST['position'];
    $birthday = $_POST['birthday'];
    $notes = $_POST['notes'];
    $nickname = $_POST['nickname'];
    $website = $_POST['website'];

    // Insert data into database
    $sql = "INSERT INTO contacts (name, phone, address, email, company, position, birthday, notes, nickname, website)
            VALUES ('$name', '$phone', '$address', '$email', '$company', '$position', '$birthday', '$notes', '$nickname', '$website')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>New contact added successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonebook Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .form-group {
            flex: 1 1 calc(50% - 20px); /* Two columns */
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px; /* Reduced from 10px */
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px; /* Slightly smaller font */
        }
        textarea {
            resize: vertical;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Add Contact</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address"></textarea>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" id="company" name="company">
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" id="position" name="position">
        </div>
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" id="birthday" name="birthday">
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes"></textarea>
        </div>
        <div class="form-group">
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname">
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" id="website" name="website">
        </div>
        <div style="flex: 1 1 100%; margin-top: 20px;">
            <button type="submit">Add Contact</button>
        </div>
    </form>
</body>
</html>
