<?php require 'components/header.php' ?>
    <h1>Books</h1>
    <p>Here you can find a collection of books.</p>
    <div class="books">
    <?php foreach ($books as $book): ?>
        <div class="book">
            <img src='<?= $book['image_url'] ?>' alt="<?= $book['name'] ?>" />
            <p><?= $book['author'] ?></p>
            <h2><?= $book['name'] ?></h2>
            <?php if ($_SESSION['user']['permission_level'] ?? 0 > 0): ?>
                <div>
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
    </div>

    <?php if ($_SESSION['user']['permission_level'] ?? 0 > 0): ?>
    <div>
        <form method="GET" action="/books/create">
            <button class="yes">Create</button>
        </form>
    </div>
    <?php endif; ?>
<?php require 'components/footer.php' ?>