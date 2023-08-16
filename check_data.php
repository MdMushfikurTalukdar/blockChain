<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['search'])) {
    $search_data = $_POST['search_data'];

    $search_hash = hash('sha256',$search_data);
    // Search for the data in the blockchain
    $sql = "SELECT * FROM blockchain WHERE data_hash = '$search_hash'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Matching Blocks Found</h2>";
        echo "Verified";
        
    } else {
        echo "<h2>No Matching Blocks Found</h2>";
    }
}

$conn->close();
?>
