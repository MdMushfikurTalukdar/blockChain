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

// Function to add a new block to the blockchain
function addBlockToBlockchain($data) {
    global $conn;

    // Get the hash of the previous block (if any)
    $sql = "SELECT block_hash FROM blockchain ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    $previous_block_hash = ($result->num_rows > 0) ? $result->fetch_assoc()['block_hash'] : '0';

    // Generate a new block hash
    $block_hash = hash('sha256', $previous_block_hash . $data . time());
    $data_hash = hash('sha256',$data);

    // Insert the new block into the database
    $sql = "INSERT INTO blockchain (block_hash, previous_block_hash, data, data_hash) VALUES ('$block_hash', '$previous_block_hash', '$data', '$data_hash')";
    if ($conn->query($sql) === TRUE) {
        echo "Block added successfully.\n";
    } else {
        echo "Error adding block: " . $conn->error;
    }
}

// Function to get the entire blockchain
function getBlockchain() {
    global $conn;

    $sql = "SELECT * FROM blockchain ORDER BY id ASC";
    $result = $conn->query($sql);

    $blockchain = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $blockchain[] = $row;
        }
    }

    return $blockchain;
}

// Test the blockchain
addBlockToBlockchain("Block 1 Data");
addBlockToBlockchain("Block 2 Data");
addBlockToBlockchain("Block 3 Data");

// Get the blockchain and print it
$blockchain = getBlockchain();
foreach ($blockchain as $block) {
    echo "Block Hash: " . $block['block_hash'] . "\n";
    echo "Previous Block Hash: " . $block['previous_block_hash'] . "\n";
    echo "Data Hash: " .$block['data_hash']."\n";
    echo "Data: " . $block['data'] . "\n";
    echo "Timestamp: " . $block['timestamp'] . "\n";
    echo "---------------------------------------\n";
}

$conn->close();
?>
