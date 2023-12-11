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
    die("Database connection error: " . $e->getMessage());
}

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Get contactId from URL
$contactId = isset($_GET['contactId']) ? (int)$_GET['contactId'] : 0;

// Fetch contact details
$contact = null;
$createdByName = "Unknown"; // Default to Unknown

if ($contactId > 0) {
    $stmt = $pdo->prepare("SELECT * FROM Contacts WHERE id = ?");
    $stmt->execute([$contactId]);
    $contact = $stmt->fetch();

    if ($contact) {
        // Fetch user details for 'assigned_to'
        $assignedToStmt = $pdo->prepare("SELECT firstname, lastname FROM Users WHERE id = ?");
        $assignedToStmt->execute([$contact['assigned_to']]);
        $assignedToUser = $assignedToStmt->fetch();
        $assignedToName = $assignedToUser ? $assignedToUser['firstname'] . ' ' . $assignedToUser['lastname'] : "Not Assigned";

        // Fetch user details for 'created_by'
        $createdByStmt = $pdo->prepare("SELECT firstname, lastname FROM Users WHERE id = ?");
        $createdByStmt->execute([$contact['created_by']]);
        $createdByUser = $createdByStmt->fetch();
        if ($createdByUser) {
            $createdByName = $createdByUser['firstname'] . ' ' . $createdByUser['lastname'];
        } else {
            error_log("User with ID {$contact['created_by']} not found."); // Log the error for debugging
        }
    } else {
        die("Contact not found.");
    }
} else {
    die("Contact ID not provided.");
}
$notes = [];
if ($contact) {
    // ... [fetching contact and user details]

    // Fetch notes for the contact
    $notesStmt = $pdo->prepare("SELECT n.comment, n.created_at, u.firstname, u.lastname 
                                FROM Notes n
                                JOIN Users u ON n.created_by = u.id
                                WHERE n.contact_id = ?
                                ORDER BY n.created_at DESC");
    $notesStmt->execute([$contactId]);
    $notes = $notesStmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Document</title>
</head>
<body>
    <div class="view_contact_details">
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
        <div class="view_contact_details_box">
            <div class="contact-details">
                <div class="img-name">
                    <img src="./images/profile.png" alt="">
                    <div class="name-created-at">
                        <h1><?php echo htmlspecialchars($contact['title'] . ' ' . $contact['firstname'] . ' ' . $contact['lastname']); ?></h1>
                        <p>Created on  <?php echo date("F j, Y", strtotime($contact['created_at'])); ?> by <?php echo htmlspecialchars($createdByName); ?></p>
                        <p>Updated on <?php echo date("F j, Y", strtotime($contact['updated_at'])); ?></p>
                    </div>
                </div>
                <div class="button-controls">
                    <button id="assign-to-me-btn"><span class="material-icons">back_hand</span>Assign to  me</button>
                    <button id="assign-new-role-btn"> <span class="material-icons">swap_horiz</span><span id="curr-role">Switch to Sales Lead</span></button>
                </div>
              
            </div>
            <div class="personal-contact-details">
                <div class="field">
                    <label for="">Email</label>
                    <p><?php echo htmlspecialchars($contact['email']); ?></p>
                </div>
                <div class="field">
                    <label for="">Telephone</label>
                    <p><?php echo htmlspecialchars($contact['telephone']); ?></p>
                </div>
                <div class="field">
                    <label for="">Company</label>
                    <p><?php echo htmlspecialchars($contact['company']); ?></p>
                </div>
                <div class="field">
                    <label for="">AssignedTo</label>
                    <p><?php echo htmlspecialchars($assignedToName); ?></p>
                </div>
            </div>
            <div class="note-section">
                <div class="note-icon"><span><span class="material-icons">edit</span> Notes</span></div>
                <!-- <div class="add-note">
                    <label for="">Add a note about Michael</label>
                    <textarea name="" id="" cols="18" rows="10"  placeholder="Enter details here"></textarea>
                    <button>Add note</button>
                </div> -->
                <!-- PUT NOTES HERE -->
                <div class="notes-display">
                    <?php foreach ($notes as $note): ?>
                        <div class="note">
                            <p class="note-author"><?php echo htmlspecialchars($note['firstname'] . ' ' . $note['lastname']); ?></p>
                            <p class="note-comment"><?php echo htmlspecialchars($note['comment']); ?></p>
                            <p class="note-meta"><?php echo date("F j, Y, g:i a", strtotime($note['created_at'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <form id="add-note-form" class="add-note">
                    <label for="note-text">Add a note about <?php echo htmlspecialchars($contact['firstname']); ?></label>
                    <textarea id="note-text" name="note" cols="30" rows="8" placeholder="Enter details here"></textarea>
                    <input type="hidden" name="contactId" value="<?php echo $contactId; ?>">
                    <input type="hidden" name="userId" value="<?php echo $_SESSION['user']['id']; ?>">
                    <button type="submit">Add Note</button>
                </form>
            </div>
           
        </div>
    </div> 
    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var switchRoleBtn = document.getElementById('assign-new-role-btn');

            if (switchRoleBtn) {
                switchRoleBtn.addEventListener('click', function() {
                    var currentRole = '<?php echo $contact['type']; ?>';
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'switch_role.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (this.status === 200) {
                            var response = JSON.parse(this.responseText);
                            alert(response.message);
                            if (response.success) {
                                // Update the page or reload
                                window.location.reload();
                            }
                        } else {
                            alert('Error with the request.');
                        }
                    };
                    xhr.send('contactId=<?php echo $contactId; ?>&currentRole=' + currentRole);
                });

                // Set the initial text of the button based on the contact's current role
                var buttonText = '<?php echo $contact['type'] === 'Sales Lead' ? 'Switch to Support' : 'Switch to Sales Lead'; ?>';
                var curr_role=document.querySelector('#curr-role')
                curr_role.textContent = buttonText;
            }
        
        });
    </script>

</body>
</html>