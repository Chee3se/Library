<?php require 'components/header.php' ?>

    <div class="book_container">
        <?php foreach ($books as $book): ?>
            <div class="book">
                <img src="<?php echo $book['image_url'] ?>" alt="Book cover">
                <h2><?php echo $book['name'] ?></h2>

                <form action="/return" method="post">
                    <input type="hidden" name="book_id" value="<?php echo $book['id'] ?>">

                    <button class="yes" > Return Book </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

<?php require 'components/footer.php' ?>