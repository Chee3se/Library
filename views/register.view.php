<?php require 'components/header.php' ?>
<h1>Register</h1>
<form action="/register" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"/>
    <label for="password">Password</label>
    <input type="password" id="password" name="password"/>
    <label for="email">E-mail<br/></label>
    <input type="email" id="email" name="email"/>
    <br/>
    <button class="yes" type="submit">Register</button>
</form>
<?php require 'components/footer.php' ?>
