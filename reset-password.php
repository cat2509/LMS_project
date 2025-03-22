<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.banner {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 7vh;
    background-color: #b91a1a;
}
.container {
    width: 400px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}
h2 {
    color: #444444;
    margin-bottom: 20px;
}

p {
    font-size: 14px;
    color: gray;
    margin-bottom: 20px;
}
.input {
    margin-bottom: 15px;
    text-align: left;
}

.input label {
    display: block;
    margin-bottom: 5px;
}

.input input {
    width: 100%;
    padding: 10px;
    border: 1px solid #444444;
    border-radius: 4px;
}

.password-container {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 18px;
    color: #444444;
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
}

button:hover {
    background-color: #444444;
}

.error {
    color: red;
    margin-top: 10px;
}

.success {
    color: green;
    margin-top: 10px;
}

.forgot-password {
    text-align: center;
    margin-top: 10px;
}

.forgot-password a {
    color: #444444;
    text-decoration: none;
}

.forgot-password a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
<div class="banner"></div>

    <div class="container">
        <h2>Reset Password</h2>
        <form method="post" action="process-reset-password.php">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <div class="input">
                <label for="password">New password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input">
                <label for="password_confirmation">Repeat password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>
