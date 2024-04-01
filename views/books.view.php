<?php require 'components/header.php' ?>
    <h1>Books</h1>
    <p>Here you can find a collection of books.</p>
    <form class="search" action="/books" method="GET">
        <input class="look" id="name" name="name" type="text" placeholder="Search" />
        <button class="look"><img src="/icons/search.svg"/></button>
    </form>
    <div class="books">
    <?php if (empty($books)) { ?>
        <h2 class="found">No books found that match your criteria</h2>
    <?php } else { ?>
    <?php foreach ($books as $book): ?>
        <div class="book">
            <a class="atext" href="/book?name=<?= $book['name'] ?>"><img src='<?= $book['image_url'] ?>' alt="<?= $book['name'] ?>" /></a>
            <a class="atext" href="/books?author=<?= $book['author'] ?>"><p><?= $book['author'] ?></p></a>
            <a class="atext" href="/book?name=<?= $book['name'] ?>"><h2><?= $book['name'] ?></h2></a>
            <?php if ($_SESSION['user']['permission_level'] ?? 0 > 0): ?>
                <div class="settings">
                    <form method="POST" action="/books/delete">
                        <input id="id" name="id" type="hidden" value=<?=$book['id']?> />
                        <button class="no">Delete</button>
                    </form>
                    <form method="GET" action="/books/edit">
                        <input id="id" name="id" type="hidden" value=<?=$book['id']?> />
                        <button class="blu">Edit</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <?php } ?>
    </div>

    <?php if ($_SESSION['user']['permission_level'] ?? 0 > 0): ?>
    <div>
        <form method="GET" action="/books/create">
            <button class="yes">Create</button>
        </form>
    </div>
    <?php endif; ?>
<?php require 'components/footer.php' ?>