<?php
session_start();

// Database connection parameters
$host = 'localhost'; 
$db = 'dolphin_crm'; 
$user = 'user'; 
$pass = 'password123'; 
$charset = 'utf8mb4';

// Create PDO instance
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection error: ' . $e->getMessage()]);
    exit;
}

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contactId = $_POST['contactId'] ?? 0;
    $currentRole = $_POST['currentRole'] ?? '';

    // Determine the new role
    $newRole = $currentRole === 'Sales Lead' ? 'Support' : 'Sales Lead';

    // Update the contact
    $stmt = $pdo->prepare("UPDATE Contacts SET type = ? WHERE id = ?");
    $stmt->execute([$newRole, $contactId]);

    echo json_encode(['success' => true, 'message' => 'Contact role updated to ' . $newRole]);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}
?>
