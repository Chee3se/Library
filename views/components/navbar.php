<nav>
    <a class=<?php if ($_SERVER['REQUEST_URI'] == "/") {echo "active";} else {echo "none";}?> href="/">Home</a>
    <a class=<?php if ($_SERVER['REQUEST_URI'] == "/books") {echo "active";} else {echo "none";}?>  href="/books">Books</a>
</nav>