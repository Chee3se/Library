<?php require 'components/header.php' ?>

    <div class="book_container checkout">
        <?php foreach ($books as $book): ?>
            <div class="book">
                <img src="<?php echo $book['image_url'] ?>" alt="Book cover">
                <h2><?php echo $book['name'] ?></h2>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if (isset($errors)) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li class="error"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form class="checkout" action="/checkout" method="post">
        <label for="return_date">Return Date:</label>
        <input type="date" id="return_date" name="return_date" required>
        <br/>
        <button class="yes" type="submit">Borrow Books</button>
    </form>

<?php require 'components/footer.php' ?>