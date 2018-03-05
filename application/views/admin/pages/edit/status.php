<div class="page-container">
    <div class="page-content">
        <form id="form" method="post">
            <div class="form-group">
                <label for="exampleSelect1">Category Name</label>
                <input type="text" class="form-control" name="name" placeholder="Type the category name here" value="<?= $status['status_name'] ?>">
            </div>

            <div class="form-group">
                <label for="exampleSelect1">Level</label>
                <select class="form-control" id="exampleSelect1" name="level" required>
                    <?php
                    foreach ($levels as $level){
                        ?>
                        <option value="<?= $level ?>" <?= ($status['status_level'] == $level)? 'selected' : ''; ?>><?= ucfirst($level) ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleTextarea">Info</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="info" required><?= $status['status_info'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-outline-success">Submit</button>
        </form>
    </div>
</div>
<script>
    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();
        <?= ajax('POST', 'editstatus', '$(this).serialize()', $status['status_id']) ?>
    });
</script>