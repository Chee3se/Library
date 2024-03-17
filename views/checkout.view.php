<?php require 'components/header.php' ?>

    <div class="book_container">
        <?php foreach ($books as $book): ?>
            <div class="book">
                <img src="<?php echo $book['image_url'] ?>" alt="Book cover">
                <h2><?php echo $book['name'] ?></h2>
            </div>
        <?php endforeach; ?>
    </div>

    <form action="/checkout" method="post">
        <label for="return_date">Return Date:</label>
        <input type="date" id="return_date" name="return_date" required>
        <input class="yes" type="submit" value="Borrow Books">
    </form>

<?php require 'components/footer.php' ?>