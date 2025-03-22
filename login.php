<?php
$is_invalid = false;
if($_SERVER["REQUEST_METHOD"] === "POST")
{
   $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM user WHERE email = '%s'",
    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    
    if ($user) // Verify login
    { 
        if(password_verify($_POST["password"], $user["password_hash"])){
            session_start();
            $_SESSION["user_id"] = $user["id"];

            header("Location: layout.php");
            exit();
        }
    }

    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@3.1.2/build/jwt-decode.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
        }
        .container1 {
            display: flex;
            justify-content: right;
            align-items: center;
            height: 88vh;
            width: 87%;
            background-color: #ffffff;
            border-radius: 8px;
            padding-top: 50px;
            gap: 163px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #444444;
        }
        .input {
            margin-bottom: 15px;
        }
        .input label {
            display: block;
            margin-bottom: 5px;
        }
        .input input {
            width: 100%;
            padding: 8px;
            border: 1px solid #444444;
            border-radius: 4px;
            color: #444444;
            box-sizing: border-box;
        }
        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        .password-container input {
            width: 100%;
            padding-right: 30px;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
            user-select: none;
            color: #444444;
        }
        .toggle-password:hover {
            color: #b91a1a;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #b91a1a;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        button:hover {
            background-color: #444444;
        }
        p {
            text-align: center;
            margin-top: 20px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
        .forgot-password a {
            color: #444444;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        .banner {
            position: absolute;
            z-index: 1;
            background-color: #b91a1a;
            height: 7vh;
            width: 100%;
        }
        .logo {
            text-align: center;
        }
        .nav {
            position: absolute;
            z-index: 2;
            width: 20%;
            background-color: #ed1c24;
            height: 7vh;
        }
        .container {
            width: 29%;
        }
        @media (max-width: 693px) {
            .container {
                width: 100%;
            }
        }
        .imgcontainer {
            height: 112vh;
            overflow: hidden;
        }
        .bg-image {
            position: relative;
            top: -78px;
            width: 906px;
        }
    </style>
</head>
<body>
    <div class="nav"></div>
    <div class="banner"></div>
    <div class="container1">
        <div class="imgcontainer">
            <img class="bg-image" src="img/BG-login.jpg" alt="">
        </div>
        <div class="container">
            <div class="logo">
                <img src="img/Kjsit_logo.png" alt="">
            </div>
            <h2>Welcome to Somaiya</h2>
            <form method="post">
                <?php if ($is_invalid): ?>
                    <p style="color: red; text-align: center;">Invalid Login</p>
                <?php endif; ?>
                
                <div class="input">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                           value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>
                </div>

                <div class="input">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required>
                        <span class="toggle-password">👁️</span>
                    </div>
                    <p class="forgot-password"><a href="forgotpassword.php">Forgot Password?</a></p>
                    <button type="submit">Login</button>
                </div>
            </form>
            <div id="google-signin"></div>
        </div>
    </div>

    <script>
       document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.querySelector(".toggle-password");
    const passwordField = document.getElementById("password");

    toggleButton.textContent = "👁️"; 

    toggleButton.addEventListener("click", function() {
        passwordField.type = passwordField.type === "password" ? "text" : "password";
        toggleButton.textContent = "👁️"; 
    });
});

    </script>
</body>
</html>
