<?php require 'components/header.php' ?>
<h1>Register</h1>
<?php if (isset($errors)) : ?>
<ul>
<?php foreach ($errors as $error) : ?>
    <li class="error"><?= $error ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<form action="/register" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"/>
    <label for="password">Password</label>
    <input type="password" id="password" name="password"/>
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation"/>
    <label for="email">E-mail<br/></label>
    <input type="email" id="email" name="email"/>
    <br/>
    <button class="yes" type="submit">Register</button>
</form>
<?php require 'components/footer.php' ?>
