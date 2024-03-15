<?php require 'components/header.php' ?>
    <h1>Books</h1>
    <p>Here you can find a collection of books.</p>
    <ul>
        <?php foreach ($books as $book): ?>
        <li>
            <p><?= $book['name'] ?></p>
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
        </li>
        <?php endforeach; ?>
    </ul>
<?php require 'components/footer.php' ?>