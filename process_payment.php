<?php
$servername = "localhost";
$username = "kingvon"; 
$password = "adidasmafia1"; 
$database = "cc";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data (consider additional validation and sanitation)
$card_holder = isset($_POST['card_holder']) ? $conn->real_escape_string($_POST['card_holder']) : '';
$card_number = isset($_POST['card_number']) ? $conn->real_escape_string($_POST['card_number']) : '';
$expiry_date = isset($_POST['expiry_date']) ? $conn->real_escape_string($_POST['expiry_date']) : '';
$cvv = isset($_POST['cvv']) ? $conn->real_escape_string($_POST['cvv']) : '';

// Insert data into MySQL (use prepared statements to prevent SQL injection)
$sql = "INSERT INTO details (card_holder, card_number, expiry_date, cvv) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssd", $card_holder, $card_number, $expiry_date, $cvv);

if ($stmt->execute()) {
    echo "Payment successful. Transaction details stored.";
} else {
    echo "Error: " . $sql . "<br>" . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
