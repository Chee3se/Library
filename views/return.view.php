<?php require 'components/header.php' ?>

    <div class="book_container">
        <?php foreach ($borrowed_books as $borrowed_book): ?>
            <div class="book">
                <img src="<?= $books[$borrowed_book['id']]['image_url'] ?>" alt="Book cover">
                <h2><?= $books[$borrowed_book['id']]['name'] ?></h2>
                <p>Amount: <?= $borrowed_book['count'] ?></p>

                <form action="/return" method="post">
                    <input type="hidden" name="borrowed_books_id" value="<?= $borrowed_book['id'] ?>" />
                    <button class="yes" > Return Book </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

<?php require 'components/footer.php' ?>