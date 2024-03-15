<?php require 'components/header.php' ?>
<h1>Create</h1>
<section>
    <form action="/books/create" method="post">
        <?php require 'components/book_form.php' ?>
        <button class="yes" type="submit">Create</button>
    </form>
</section>
<?php require 'components/footer.php' ?>
