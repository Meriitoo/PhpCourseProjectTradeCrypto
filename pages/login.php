<?php

?>

<div class="login-box">
    <h1>Login</h1>
    <form  method="POST"  action="./handlers/handle_login.php">
        <label>Email</label>
        <input type="text" name="email" placeholder="Email.." value="<?php echo $_COOKIE['user_email'] ?? '' ?>">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password..">
        <input type="submit" value="Submit">
    </form>
    <p>Not have an account? <a href="?page=register">Register here</a></p>
</div>