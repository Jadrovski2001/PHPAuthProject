<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
        body
        { font: 14px sans-serif;
          text-align: center;
        }
        h1, p
        {
          text-align: center;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
    <div class="welcome-container">
        <h1 class="my-3">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome!</h1>
        <p>
        </p>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>