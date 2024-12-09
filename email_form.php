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

// Handle the email sending process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    
    // Fetch all user emails from the database
    $sql = "SELECT email FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Send email to all users
        while ($row = $result->fetch_assoc()) {
            $to = $row['email'];
            $headers = "From: admin@gmail.com\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            
            // Send email to each user
            if (mail($to, $subject, $message, $headers)) {
                echo "Email sent successfully to $to<br>";
            } else {
                echo "Failed to send email to $to<br>";
            }
        }
    } else {
        echo "No users found to send emails to.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email to Users</title>
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
            width: 100%;
            max-width: 800px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
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
    <h1>Send Email to All Users</h1>
    <form method="POST">
        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject" placeholder="Enter email subject" required>
        
        <label for="message">Message</label>
        <textarea name="message" id="message" rows="6" placeholder="Enter your message here..." required></textarea>
        
        <button type="submit">Send Email to All Users</button>
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
