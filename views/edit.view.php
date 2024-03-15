<?php require 'components/header.php' ?>
<h1>Edit book</h1>
<section>
    <form method="POST" action="/books/edit">
    <input id="id" name="id" type="hidden" value="<?=$book['id']?>" />
        <?php require 'components/book_form.php' ?>
        <button class="yes">Save</button>
    </form>
</section>
<?php require 'components/footer.php' ?>