<!DOCTYPE html>
<html>
<head>
    <title>
        PUPQC e-ReLiv Faculty/Admin Login
    </title>
    <link rel="stylesheet" href="https://meyerweb.com/eric/tools/css/reset/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
    <link rel="stylesheet" href="styles/fclty-admn-login.css">
</head>
<body>
    <div class="container-login-form">
    <fieldset class="black-box">
        <div class="container-logo">
            <img class="pupqc-logo" src="assets/pupqc-logo.webp">
        </div>
        <h1 class="title">PUPQC Faculty/Admin Login Form</h1>
        <form
            method="POST"
            action="backend/stafflogin_backend.php"
            class="grid-container"
        >
            <label for="username">Username:</label>
            <input
            type="text"
            id="username"
            name="username"
            required
            />
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />
            <button type="submit" class="submit-button">Submit</button>
        </form>
        <a href="/html codes/faculty-admin-login.html"><p class="forgot-password">Forgot Password</p>
        </a>
    </fieldset>
    </div>
</body>
</html>