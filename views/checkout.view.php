<?php require 'components/header.php' ?>

    <form class="checkout" action="/checkout" method="post">
        <table class="book_container checkout">
            <tr>
                <th>Cover</th>
                <th>Name</th>
                <th>Count</th>
            </tr>
            <?php foreach ($books as $book): ?>
                <tr class="book_table">
                    <td><img src="<?php echo $book['image_url'] ?>" alt="Book cover"></td>
                    <td><?php echo $book['name'] ?></td>
                    <td><input type="number" name="count[<?= $book['id'] ?>]" min="1" max="<?= $book['count'] ?>" value="1" required></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php if (isset($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <p class="error"><?= $error ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <label for="return_date">Return Date:</label>
        <input type="date" id="return_date" name="return_date" required>
        <br/>
        <button class="yes" type="submit">Borrow Books</button>
    </form>

<?php require 'components/footer.php' ?>