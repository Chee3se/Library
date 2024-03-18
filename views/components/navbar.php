<?php if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
} ?>
<input type="checkbox"/>
<nav>
    <a class=<?php if ($_SERVER['REQUEST_URI'] == "/") {echo "active";} else {echo "none";}?> href="/">Home</a>
    <a class=<?php if ($_SERVER['REQUEST_URI'] == "/books") {echo "active";} else {echo "none";}?>  href="/books">Books</a>
    <?php if (isset($_SESSION['user'])) { ?>
        <a class="text"> Welcome, <?php echo $_SESSION['user']['username'] ?></a>
        <a class=<?php if ($_SERVER['REQUEST_URI'] == "/return") {echo "active";} else {echo "none";}?>  href="/return">Return Books</a>
        <a class=<?php if ($_SERVER['REQUEST_URI'] == "/checkout") {echo "active";} else {echo "none";}?>  href="/checkout">Checkout</a>
        <a class=<?php if ($_SERVER['REQUEST_URI'] == "/logout") {echo "active";} else {echo "none";}?>  href="/logout">Logout</a>
    <?php } else { ?>
        <a class="text"></a>
        <a class=<?php if ($_SERVER['REQUEST_URI'] == "/return") {echo "active";} else {echo "none";}?>  href="/return">Return Books</a>
        <a class=<?php if ($_SERVER['REQUEST_URI'] == "/checkout") {echo "active";} else {echo "none";}?>  href="/checkout">Checkout</a>
        <a class=<?php if ($_SERVER['REQUEST_URI'] == "/login") {echo "active";} else {echo "none";}?>  href="/login">Login</a>
    <?php } ?>
</nav>
<img class="icons menu" src="/icons/menu.svg" alt="Menu">
<img class="icons close" src="/icons/close.svg" alt="Close">