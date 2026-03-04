<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<link rel="stylesheet" href="style.css">

<body>
    <div class="container">
        <h2>User Registration</h2>

        <form action="../src/register.php" method="POST">
            <input type="text" name="first_name" placeholder="First Name" required><br>
            <input type="text" name="middle_name" placeholder="Middle Name (Optional)"><br>
            <input type="text" name="last_name" placeholder="Last Name" required><br>
            <input type="text" name="suffix" placeholder="Suffix (Optional)"><br>

            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br><br>

            <button type="submit">Register</button>
        </form>

        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>
