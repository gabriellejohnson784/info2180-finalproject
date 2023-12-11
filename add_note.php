<?php
session_start();
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


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user'])) {
    $contactId = $_POST['contactId'] ?? '';
    $userId = $_POST['userId'] ?? '';
    $note = $_POST['note'] ?? '';

    // Perform validation
    if ($contactId === '' || $userId === '' || $note === '') {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Insert the note into the database
    $stmt = $pdo->prepare("INSERT INTO Notes (contact_id, comment, created_by, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$contactId, $note, $userId]);

    echo json_encode(['success' => true, 'message' => 'Note added successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method or not logged in.']);
}
?>
