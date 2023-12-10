<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

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

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}

// Fetch contacts from database
$sql = "SELECT * FROM Contacts";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$contacts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Dashboard - Dolphin CRM</title>
</head>
<body>
    <div class="dashboard">
        <nav class="nav-bar">
            <img src="images/Dolphin.png" alt="">
            <p>Dolphin CRM</p>
        </nav>
        <div class="side-bar">
            <ul>
                <li><a href="dashboard.php"><span class="material-icons-outlined icon" style="font-size: 2.2rem;">home</span> Home</a></li>
                <li><a href="new_contact.php"><span class="material-icons-outlined icon" style="font-size: 2.2rem;">person_add</span> New Contact</a></li>
                <li><a href="view_users.php"><span class="material-icons-outlined icon" style="font-size: 2.2rem;">group</span> Users</a></li>
                <li><a href="logout.php"><span class="material-icons-outlined icon" style="font-size: 2.2rem;">logout</span> Logout</a></li>
            </ul>
        </div>

        <div class="dashboard-box">
            <div class="header">
                <h1>Dashboard</h1>
                <button><a href="new_contact.php">Add Contact</a></button>
                
            </div>
            <div class="table-filter-box">
            <div class="filter-bar">
                    <div class="filter-icon-box">
                        <span class="material-icons" style="font-size:2rem;">filter_alt</span>
                        <span>Filter By: </span>
                    </div>
                    <div id="filter-all" class="filter-option filter-clicked" onclick="filterContacts('all')">All</div>
                    <div id="filter-sales-lead" class="filter-option" onclick="filterContacts('Sales Lead')">Sales Lead</div>
                    <div id="filter-support" class="filter-option" onclick="filterContacts('Support')">Support</div>
                    <div id="filter-assigned-to-me" class="filter-option" onclick="filterContacts('Assigned to me')">Assigned to me</div>
                </div>
                <!-- <div class="table-scrollbox"> -->
                <table>
                    <thead class="table-header">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Type</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td id="contact-name"><?php echo htmlspecialchars($contact['title'] . ' ' . $contact['firstname'] . ' ' . $contact['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($contact['email']); ?></td>
                            <td><?php echo htmlspecialchars($contact['company']); ?></td>
                            <td><span  class="<?php echo htmlspecialchars($contact['type']); ?>"><?php echo htmlspecialchars($contact['type']); ?></span></td>
                            <td>View</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- </div> -->
                
            </div>
        </div>
    </div>
    <script>
    function filterContacts(filterType) {
    // Get all filter options
    var filters = document.querySelectorAll('.filter-option');

    // Remove the 'filter-clicked' class from all filters
    filters.forEach(function(filter) {
        filter.classList.remove('filter-clicked');
    });

    // Add the 'filter-clicked' class to the clicked filter
    document.getElementById('filter-' + filterType.toLowerCase().replace(/\s+/g, '-')).classList.add('filter-clicked');

    var rows = document.getElementById('userTableBody').rows;
    for (var i = 0; i < rows.length; i++) {
        var typeCell = rows[i].cells[3].textContent;
        if (filterType === 'all' || typeCell === filterType) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

</script>
</body>
</html>
