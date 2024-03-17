<?php require 'components/header.php' ?>

<div class="book_container">
    <h1><?= $book['name'] ?></h1>
    <p>By: <?= $book['author_name'] ?></p>
    <p>Published on <?= $book['release_date'] ?></p>
    <img src='<?= $book['image_url'] ?>' alt="<?= $book['name'] ?>" />
    <p><?= $book['about'] ?></p>
    <?php if ($book['availability']): ?>
        <form method="GET" action="/checkout">
            <input id="id" name="id" type="hidden" value="<?= $book['id'] ?>" />
            <button class="yes">Add to cart</button>
        </form>
    <?php else: ?>
        <p>This book is currently unavailable.</p>
    <?php endif; ?>
</div>

<?php require 'components/footer.php' ?>
