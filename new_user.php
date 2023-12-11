<?php
session_start();

// Here you can add your PHP code for any server-side logic.
// For instance, checking if the user is logged in.
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
} 
if (isset($_GET['userid'])) {
    $userID = $_GET['userid'];
    // Do something with $userID
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>Dolphin CRM</title>
</head>
<body>
    <div class="new-user">
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
        <div class="new-user-box">
            <h1>New User</h1>
            <div class="form-box">
                <form id="addUserForm">
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
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="field">               
                        <label for="roleSelect">Role</label>
                        <select id="roleSelect" name="role">
                            <option value="Member">Member</option>
                            <option value="Admin" selected>Admin</option>
                        </select>
                    </div>
                    <button type="submit">Save</button>
                </form>
                
                <button type="submit" form="addUserForm">Save</button>
            </div>
           
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>

