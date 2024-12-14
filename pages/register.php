<?php
  
?>

<div class="register-box">
    <h1>Register</h1>
    <h4>It's free and only take a minute</h4>
    <form method="POST" action="./handlers/handle_register.php">
        <label>Username</label>
        <input type="text" name="username" placeholder="Username.." value="<?php echo $flash['data']['username'] ?? '' ?>">
        <label>Email</label>
        <input type="text" name="email" placeholder="Email.." value="<?php echo $flash['data']['email'] ?? '' ?>">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password..">
        <label>Confirm Password</label>
        <input type="password" name="repeat_password" placeholder="Confirm Password..">
        <input type="submit" value="Submit">
    </form>
    <p>Already have an account? <a href="?page=login">Login here</a></p>
</div>