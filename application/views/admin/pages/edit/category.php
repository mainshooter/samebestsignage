<div class="page-container">
    <div class="page-content">
        <form id="editcat" method="post">
            <div class="form-group">
                <label for="exampleSelect1">Category Name</label>
                <input type="text" class="form-control" name="name" placeholder="Type the category name here" value="<?= $array['cat_name'] ?>">
            </div>

            <div class="form-group">
                <label for="exampleTextarea">Info</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="info" required><?= $array['cat_info'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-outline-success">Submit</button>
        </form>
    </div>
</div>
<script>
    // Set up an event listener for the contact form.
    $('#editcat').submit(function(event) {
        event.preventDefault();
        <?= ajax('POST', 'editcategory', '$(this).serialize()', $array['cat_id']) ?>
    });
</script>