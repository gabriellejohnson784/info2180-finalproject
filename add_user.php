<?php
// Database connection parameters
$host = 'localhost'; // Database host
$db = 'dolphin_crm'; // Database name
$user = 'user'; // Database username
$pass = 'password123'; // Database password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// Create PDO instance
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection error']);
    exit;
}

// Extract data from POST request
$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// Hash the password using MySQL SHA2 function
// We use 256 bits for the hash length in this example


// Hash the password using MySQL SHA2 function
$hashedPasswordSql = "SHA2(?, 256)";

// Prepare SQL and bind parameters
$stmt = $pdo->prepare("INSERT INTO Users (firstname, lastname, email, password, role, created_at) VALUES (?, ?, ?, $hashedPasswordSql, ?, NOW())");
$stmt->bindParam(1, $firstname);
$stmt->bindParam(2, $lastname);
$stmt->bindParam(3, $email);
$stmt->bindParam(4, $password); // Bind the actual password
$stmt->bindParam(5, $role);

$stmt->execute();

echo json_encode(['success' => true, 'message' => 'User added successfully']);
?>
