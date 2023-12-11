<?php
session_start();

// Include your database connection code here
// ...

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

if (isset($_GET['userid'])) {
    $userID = $_GET['userid'];
    // Do something with $userID
}

// Fetch users from the database
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmt = $pdo->prepare("SELECT firstname, lastname, email, role, created_at FROM Users");
    $stmt->execute();
    $users = $stmt->fetchAll();
} catch (\PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="view_users">
        <nav class="nav-bar">
            <img src="images/Dolphin.png" alt="">
            <p>Dolphin CRM</p>
        </nav>
        <div class="side-bar">
            <ul>
                <li><a href="dashboard.php?userId=<?php echo htmlspecialchars($_SESSION['user']['id']);?>"><span class="material-icons-outlined icon" style="font-size: 2.2rem;">home</span> Home</a></li>
                <li><a href="new_contact.php?userId=<?php echo htmlspecialchars($_SESSION['user']['id']);?>"><span class="material-icons-outlined icon" style="font-size: 2.2rem;">person_add</span> New Contact</a></li>
                <li><a href="view_users.php?userId=<?php echo htmlspecialchars($_SESSION['user']['id']);?>"><span class="material-icons-outlined icon" style="font-size: 2.2rem;">group</span> Users</a></li>
                <li><a href="logout.php?userId=<?php echo htmlspecialchars($_SESSION['user']['id']);?>"><span class="material-icons-outlined icon" style="font-size: 2.2rem;">logout</span> Logout</a></li>
            </ul>
        </div>
        <div class="view-users-box">
            <div class="header">
                <h1>Users</h1>
                <button><a href="new_user.php">Add User</a></button>
              
            </div>
           <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <!-- Example row (repeat similar rows for each user) -->
                    <!-- <tr>
                        <td>John Doe</td>
                        <td>johndoe@example.com</td>
                        <td>User</td>
                        <td>2023-01-01</td>
                    </tr> -->
                    <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="name-col"><?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['role']); ?></td>
                                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>

           </div>
            

        </div>
    </div>
    <!-- <script src="script.js"></script> -->
</body>
</html>
