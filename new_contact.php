<?php
session_start();

// Database connection parameters
$host = 'localhost';
$db = 'dolphin_crm';
$user = 'user';
$pass = 'password123';
$charset = 'utf8mb4';

// Data Source Name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
if (isset($_GET['userid'])) {
    $userID = $_GET['userid'];
    // Do something with $userID
}
// Options for PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}

// Fetch users from database
$stmt = $pdo->prepare("SELECT id, firstname, lastname FROM Users");
$stmt->execute();
$users = $stmt->fetchAll();
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
    <div class="new_contact">
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
        <div class="new-contact-box">
            <h1>New Contact</h1>
            <div class="form-box">
                <form id="addContactForm">
                    <div class="field" id="contact-title">               
                        <label for="roleSelect">Title</label>
                        <select id="titleelect" name="title">
                            <option value="Mr">Mr</option>
                            <option value="Ms" selected>Ms</option>
                            <option value="Mrs" selected>Mrs</option>
                        </select>
                    </div>
                    <div class=""></div>
                    <div class="field">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" placeholder="Jane">
                    </div>
                    <div class="field">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Doe">
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="something@example.com">
                    </div>
                    <div class="field">
                        <label for="telephone">Telephone</label>
                        <input type="text" id="telephone" name="telephone">
                    </div>
                    <div class="field">
                        <label for="company">Company</label>
                        <input type="text" id="company" name="company">
                    </div>
                    <div class="field">               
                        <label for="roleSelect">Type</label>
                        <select id="typeSelect" name="type">
                            <option value="Sales Lead">Sales Lead</option>
                            <option value="Support" selected>Support</option>
                        </select>
                    </div>
                    <div class="field">               
                        <label for="roleSelect">Assigned To</label>
                        <select id="assignedTo" name="assigned_to">
                            <?php foreach ($users as $user): ?>
                                <option value="<?php echo $user['id']; ?>">
                                    <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    

                    <button type="submit">Save</button>
                </form>
                
                <button type="submit" form="addContactForm">Save</button>
            </div>
        </div>

        </div>
    </div>
    <!-- At the end of your body tag -->
<script src="script.js"></script>

</body>
</html>