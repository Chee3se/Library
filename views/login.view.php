<?php require 'components/header.php' ?>
<h1>Login</h1>
<?php if (isset($error)) : ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>
<form action="/login" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"/>
    <label for="password">Password</label>
    <input type="password" id="password" name="password"/>
    <br/>
    <button class="yes" type="submit">Login</button>
</form>
<p>Don't have an account?</p>
<a href="/register">Register</a>
<?php require 'components/footer.php' ?>