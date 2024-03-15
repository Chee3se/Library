<?php require 'components/header.php' ?>
<h1>Rediģēt grāmatu:</h1>
<section>
    <form method="POST" action="/books/edit">
    <input id="id" name="id" type="hidden" value="<?=$book['id']?>" />
        <label for="name">Name:</label>
        <input id="name" name="name" type="text" value="<?=$book['name']?>" />
        <label for="author">Author:</label>
        <input id="author" name="author" type="text" value="<?=$book['author']?>" />
        <label for="release_date">Release date:</label>
        <input id="release_date" name="release_date" type="date" value='<?=$book['release_date']?>' />
        <label for="availability">Availability:</label>
        <select id="availability" name="availability">
            <option value="1" <?= $book['availability'] == 1 ? 'selected' : '' ?>>Available</option>
            <option value="0" <?= $book['availability'] == 0 ? 'selected' : '' ?>>Not available</option>
        </select>
        <button class="yes">Save</button>
    </form>
</section>
<?php require 'components/footer.php' ?>