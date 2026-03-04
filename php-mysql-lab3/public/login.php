<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<link rel="stylesheet" href="style.css">
<body>
    <div class="container">
        <?php if(isset($_GET['error'])): ?>
            <div class="error">
                <p id="error">
                    <?php
                        if ($_GET['error']=="empty") echo "Please fill in all the fields.." ;
                        if ($_GET['error']=="emailnotfound") echo "Email not found" ;
                        if ($_GET['error']=="wrongpassword") echo "Incorrect Password" ;
                    ?>
                </p>
            </div>
        <?php endif; ?>
        <h2>Login</h2>

        <form action="../src/login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br><br>

            <button type="submit">Login</button>
        </form>

        <a href="register.php">Create Account</a>
    </div>
</body>
</html>

