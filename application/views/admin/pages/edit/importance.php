<div class="page-container">
    <div class="page-content">
        <form id="form" method="post">
            <div class="form-group">
                <label for="exampleSelect1">Category Name</label>
                <input type="text" class="form-control" name="name" placeholder="Type the category name here" value="<?= $importance[0]['importance_name'] ?>">
            </div>

            <div class="form-group">
                <label for="exampleSelect1">Level</label>
                <select class="form-control" id="exampleSelect1" name="level" required>
                    <?php
                    foreach ($levels as $level){
                        ?>
                        <option value="<?= $level ?>" <?= ($importance[0]['importance_level'] == $level)? 'selected' : ''; ?>><?= ucfirst($level) ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleTextarea">Info</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="info" required><?= $importance[0]['importance_info'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="exampleTextarea">Color</label>
                <input type="color" class="form-control-color" name="color" value="<?= $importance[0]['importance_color'] ?>" required>
            </div>

            <button type="submit" class="btn btn-outline-success">Submit</button>
        </form>
    </div>
</div>
<script>
    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();
        <?= ajax('POST', 'editimportance', '$(this).serialize()', $importance[0]['importance_id']) ?>
    });
</script>