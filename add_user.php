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
$firstname = $_POST['firstname'] ?? 'test';
$lastname = $_POST['lastname'] ?? 'tess';
$email = $_POST['email'] ?? 'test@test.com';
$password = $_POST['password'] ?? 'password123';
$role = $_POST['role'] ?? 'Administrator';
// Validation logic here (ensure fields are filled out, etc.)
if (empty($firstname) || empty($lastname) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Please fill out required fields']);
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL and bind parameters
$stmt = $pdo->prepare("INSERT INTO Users (firstname, lastname, email, password, role, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->execute([$firstname, $lastname, $email, $hashedPassword, $role]);

echo json_encode(['success' => true, 'message' => 'User added successfully']);
?>
