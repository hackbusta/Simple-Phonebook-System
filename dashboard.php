<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            margin-bottom: 30px;
        }
        .card-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 200px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
        }
        .card:hover {
            background-color: #007bff;
            color: #fff;
        }
        .card h3 {
            margin: 0;
            font-size: 18px;
        }
        #popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .popup-content {
            background: #fff;
            width: 80%;
            height: 80%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            position: relative;
        }
        .popup-content iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: red;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <div class="card-container">
        <div class="card" onclick="openPopup('phonebook_form.php')">
            <h3>Phonebook Form</h3>
        </div>
        <div class="card" onclick="openPopup('showphonebook.php')">
            <h3>Show Phonebook</h3>
        </div>
        <div class="card" onclick="openPopup('email_form.php')">
            <h3>Email Form</h3>
        </div>
    </div>

    <div id="popup">
        <div class="popup-content">
            <button class="close-btn" onclick="closePopup()">Close</button>
            <iframe id="popup-iframe" src=""></iframe>
        </div>
    </div>

    <script>
        // Function to open the popup with the specified URL
        function openPopup(pageUrl) {
            document.getElementById('popup-iframe').src = pageUrl;
            document.getElementById('popup').style.display = 'flex';
        }

        // Function to close the popup
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('popup-iframe').src = '';
        }
    </script>
</body>
</html>
