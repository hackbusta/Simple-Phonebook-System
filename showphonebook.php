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

// Delete operation
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM contacts WHERE id = $delete_id");
    header("Location: showphonebook.php");
    exit();
}

// Search operation
$search_query = "";
$sql = "SELECT * FROM contacts"; // Default query to retrieve all records

if (isset($_POST['search'])) {
    $search_query = trim($_POST['search_query']);
    if (!empty($search_query)) {
        // Sanitize search input to avoid SQL injection
        $search_query = $conn->real_escape_string($search_query);
        $sql = "SELECT * FROM contacts WHERE 
                name LIKE '%$search_query%' OR 
                phone LIKE '%$search_query%' OR 
                email LIKE '%$search_query%'";
    }
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Phonebook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
            font-size: 14px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .table-container {
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        thead {
            background-color: #007bff;
            color: white;
        }
        th, td {
            padding: 8px 10px;
        }
        th {
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 8px;
            width: 300px;
            font-size: 14px;
        }
        .search-container button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .search-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Phonebook Contacts</h1>
    <div class="search-container">
        <form method="POST">
            <input type="text" name="search_query" value="<?php echo htmlspecialchars($search_query); ?>" placeholder="Search contacts...">
            <button type="submit" name="search">Search</button>
        </form>
    </div>
    <div class="table-container">
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <a href="showphonebook.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a> |
                                <a href="update_contact.php?id=<?php echo $row['id']; ?>">Update</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #888;">No records found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
