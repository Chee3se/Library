<?php session_start() ?>
<nav>
    <a class=<?php if ($_SERVER['REQUEST_URI'] == "/") {echo "active";} else {echo "none";}?> href="/">Home</a>
    <a class=<?php if ($_SERVER['REQUEST_URI'] == "/books") {echo "active";} else {echo "none";}?>  href="/books">Books</a>
    <?php if (isset($_SESSION['user'])) { ?>
        <a class="text"> Welcome, <?php echo $_SESSION['user']['username'] ?></a>
        <a class=<?php if ($_SERVER['REQUEST_URI'] == "/logout") {echo "active";} else {echo "none";}?>  href="/logout">Logout</a>
    <?php } else { ?>
        <a class="text"></a>
        <a class=<?php if ($_SERVER['REQUEST_URI'] == "/login") {echo "active";} else {echo "none";}?>  href="/login">Login</a>
    <?php } ?>
</nav>