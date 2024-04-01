<label for="name">Name</label>
<input id="name" name="name" type="text" value="<?=$book['name'] ?? null?>" />
<?php check($errors ?? [], 'name'); ?>
<label for="author_id">Author</label>
<select id="author_id" name="author_id">
    <?php foreach ($authors as $author): ?>
        <option value="<?=$author['id']?>" <?= $author['id'] == ($book['author_id'] ?? 1) ? 'selected' : '' ?>><?=$author['name']?></option>
    <?php endforeach; ?>
</select>
<?php check($errors ?? [], 'author_id'); ?>
<label for="image">Image</label>
<input id="image" name="image" type="file" />
<?php check($errors ?? [], 'image'); ?>
<label for="release_date">Release date</label>
<input id="release_date" name="release_date" type="date" value='<?=$book['release_date'] ?? date("Y-m-d")?>' />
<?php check($errors ?? [], 'release_date'); ?>
<label for="about">About</label>
<textarea id="about" name="about"><?=$book['about'] ?? null?></textarea>
<?php check($errors ?? [], 'about'); ?>
<label for="count">Book count</label>
<input id="count" name="count" type="number" value="<?=$book['count'] ?? 1?>" />
<?php check($errors ?? [], 'count'); ?>
<label for="availability">Availability</label>
<select id="availability" name="availability">
    <option value="Available" <?= ($book['availability'] ?? "Available") == "Available" ? 'selected' : '' ?>>Available</option>
    <option value="Not Available" <?= ($book['availability'] ?? "Available") == "Not Available" ? 'selected' : '' ?>>Not available</option>
</select>
<?php check($errors ?? [], 'availability'); ?>

<?php function check($errors, $field) {
    if (isset($errors[$field])) {
        foreach ($errors[$field] as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
} ?>


