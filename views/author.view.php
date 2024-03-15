<?php require 'components/header.php' ?>
<h1>Create author</h1>
<section>
    <form action="/author" method="POST">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
        <button class="yes" type="submit">Create</button>
    </form>
</section>
<?php require 'components/footer.php' ?>
