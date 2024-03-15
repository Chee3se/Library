<label for="name">Name</label>
<input id="name" name="name" type="text" value="<?=$book['name'] ?? null?>" />
<label for="author_id">Author</label>
<select id="author_id" name="author_id">
    <?php foreach ($authors as $author): ?>
        <option value="<?=$author['id']?>" <?= $author['id'] == ($book['author_id'] ?? 1) ? 'selected' : '' ?>><?=$author['name']?></option>
    <?php endforeach; ?>
</select>
<label for="image_url">Image URL</label>
<input id="image_url" name="image_url" type="text" value="<?=$book['image_url'] ?? null?>" />
<label for="release_date">Release date</label>
<input id="release_date" name="release_date" type="date" value='<?=$book['release_date'] ?? date("Y-m-d")?>' />
<label for="availability">Availability</label>
<select id="availability" name="availability">
    <option value="1" <?= ($book['availability'] ?? 1) == 1 ? 'selected' : '' ?>>Available</option>
    <option value="0" <?= ($book['availability'] ?? 1) == 0 ? 'selected' : '' ?>>Not available</option>
</select>