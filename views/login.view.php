<?php require 'components/header.php' ?>
<h1>Login</h1>
<?php if (isset($error)) : ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>
<form action="/login" method="post" class="login">
    <label for="username">Username</label>
    <img src="/icons/user.svg" alt="USER"/>
    <input type="text" id="username" name="username"/>
    <label for="password">Password</label>
    <img src="/icons/pass.svg" alt="PASSWORD"/>
    <input type="password" id="password" name="password"/>
    <br/>
    <button class="yes" type="submit">Login</button>
</form>
<p>Don't have an account?</p>
<a href="/register">Register</a>
<?php require 'components/footer.php' ?>