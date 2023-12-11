<?php
session_start();

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
    die("Database connection error: " . $e->getMessage());
}

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $hashedPassword = hash('sha256', $password); // Hashing the input password for comparison
        if ($hashedPassword == $user['password']) {
            $_SESSION['user'] = $user;
            // header("Location: dashboard.php");
            header("Location: dashboard.php?userId=" . $user['id']);
            exit;
        } else {
            $errorMessage = 'Invalid credentials';
        }
    } else {
        $errorMessage = 'Invalid credentials';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login - Dolphin CRM</title>
</head>
<body>
    <div class="login">
        <nav class="nav-bar">
            <img src="images/Dolphin.png" alt="Dolphin CRM">
            <p>Dolphin CRM</p>
        </nav>
        <div class="login-box">
            <h1>Login</h1>
            <?php if ($errorMessage): ?>
                <p class="error"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php endif; ?>
            <form action="login.php" method="post" id="loginForm">
                <input type="email" name="email" placeholder="Email address" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
        <footer class="footer">
            Copyright & Copyright 2022 Dolphin CRM
        </footer>
    </div>
    <!-- <script src="script.js"></script> -->
</body>
</html>
