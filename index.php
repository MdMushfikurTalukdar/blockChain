<!DOCTYPE html>
<html>
<head>
    <title>Simple Blockchain Frontend</title>
</head>
<body>
    <h1>Simple Blockchain Frontend</h1>

    <form action="" method="post">
        <label for="data">Enter Data for New Block:</label>
        <input type="text" name="data" id="data" required>
        <button type="submit" name="addBlock">Add Block</button>
    </form>

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
        $data_hash = hash('sha256',$data);

        // Generate a new block hash
        $block_hash = hash('sha256', $previous_block_hash . $data . time());

        // Insert the new block into the database
        $sql = "INSERT INTO blockchain (block_hash, previous_block_hash, data,data_hash) VALUES ('$block_hash', '$previous_block_hash', '$data','$data_hash')";
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
    if (isset($_POST['addBlock'])) {
        $data = $_POST['data'];
        addBlockToBlockchain($data);
    }

    // Get the blockchain and display it
    $blockchain = getBlockchain();
    if (!empty($blockchain)) {
        echo "<h2>Blockchain</h2>";
        foreach ($blockchain as $block) {
            echo "<p>Block Hash: " . $block['block_hash'] . "</p>";
            echo "<p>Previous Block Hash: " . $block['previous_block_hash'] . "</p>";
            echo "<p>Data Hash: " . $block['data_hash'] . "</p>";
            echo "<p>Data: " . $block['data'] . "</p>";
            echo "<p>Timestamp: " . $block['timestamp'] . "</p>";
            echo "<hr>";
        }
    } else {
        echo "<p>No blocks in the blockchain yet.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
