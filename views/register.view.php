<?php require 'components/header.php' ?>
<h1>Register</h1>
<?php check($errors ?? [], 'all'); ?>
<form action="/register" method="post">
    <div class="fix">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"/>
    </div>
    <?php check($errors ?? [], 'username'); ?>
    <div class="fix">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"/>
    </div>
    <?php check($errors ?? [], 'password'); ?>
    <div class="fix">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation"/>
    </div>
    <?php check($errors ?? [], 'confirm_password'); ?>
    <div class="fix">
        <label for="email">E-mail<br/></label>
        <input type="email" id="email" name="email"/>
    </div>
    <?php check($errors ?? [], 'email'); ?>
    <br/>
    <button class="yes" type="submit">Register</button>
</form>
<?php require 'components/footer.php' ?>

<?php function check($errors, $field) {
    if (isset($errors[$field])) {
        foreach ($errors[$field] as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
} ?>
