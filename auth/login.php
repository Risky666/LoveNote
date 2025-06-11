<?php
echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css" />

</head>
<body>
    <!--ketika form di submit akan mengarah ke login_proses.php untuk logikanya-->
    <form method="POST" action="login_process.php">
        <h2>Login</h2>
        <label>Username:</label>
        <input type="text" name="username" required />
        <label>Password:</label>
        <input type="password" name="password" required />
        <button type="submit">Login</button>
    </form>
</body>
</html>
HTML;
?>
