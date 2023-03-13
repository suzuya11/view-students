<?php
session_start();

// Check if the logout parameter is set
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
	// Destroy the session
	session_destroy();
	// Redirect to login page
	header('Location: index.php');
	exit();
}

// Redirect to home page if user is already logged in
if(isset($_SESSION['username'])) {
    header("Location: view.php");
    exit();
}

// Define an array of valid users
$users = array(
    'admin' => 'admin',
    'brianhambre' => 'brian123',
    'Mark' => 'mark123',
    'Carlo' => 'carlo123',
    'Eve' => 'eve123'
);

// Check if the form was submitted
if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if username and password are valid
    if(array_key_exists($username, $users) && $users[$username] == $password) {
        // Set session variable for the user
        $_SESSION['username'] = $username;

        // Set cookie variable for the login time
        setcookie('login_time', date('Y-m-d H:i:s'), time() + 3600); // expire after 30 days

        // Redirect to home page
        header("Location: view.php");
        exit();
    } else {
        $error_message = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if(isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>
