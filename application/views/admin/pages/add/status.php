<div class="page-container">
    <div class="page-content">
        <form id="form" method="post">
            <div class="form-group">
                <label for="exampleSelect1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Type the name here">
            </div>

            <div class="form-group">
                <label for="exampleSelect1">Level</label>
                <select class="form-control" id="exampleSelect1" name="level" required>
                    <option selected disabled>Select a status level</option>
                    <?php
                    foreach ($array as $item){
                        ?>
                        <option value="<?= $item ?>"><?= ucfirst($item) ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleTextarea">Info</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="info" required></textarea>
            </div>

            <button type="submit" class="btn btn-outline-success">Submit</button>
        </form>
    </div>
</div>
<script>
    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        <?= ajax('POST', 'addStatus', '$(this).serialize()') ?>
    });
</script>