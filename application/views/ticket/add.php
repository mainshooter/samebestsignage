<div class="page-container">
    <div class="page-content">
        <form id="form" method="post">
            <div class="form-group">
                <label for="exampleSelect1">Handler</label>
                <select class="form-control" id="exampleSelect1" name="user" required>
                    <option selected disabled>Choose a user</option>
                    <?php
                    foreach ($users as $item){
                        ?>
                        <option value="<?= $item['id'] ?>"><?= ucfirst($item['username']). ': ' .$item['email'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleSelect1">Category</label>
                <select class="form-control" id="exampleSelect1" name="category" required>
                    <option selected disabled>Choose a category</option>
                    <?php
                    foreach ($categorys as $item){
                        ?>
                        <option value="<?= $item['alert_id'] ?>"><?= $item['alert_name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleSelect1">Status</label>
                <select class="form-control" id="exampleSelect1" name="status" required>
                    <?php
                    foreach ($statuses as $item){
                        ?>
                        <option value="<?= $item['status_id'] ?>"><?= $item['status_name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleSelect1">Importance</label>
                <select class="form-control" id="exampleSelect1" name="importance" required>
                    <option selected disabled>Choose a level</option>
                    <?php
                    foreach ($importances as $item){
                        ?>
                        <option value="<?= $item['importance_id'] ?>"><?= $item['importance_name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleTextarea">Problem</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" name="problem" required></textarea>
            </div>

            <button type="submit" class="btn btn-ou">Submit</button>
        </form>
    </div>
</div>
<script>
    // Set up an event listener for the contact form.
    $('form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>" + "ajax/addticket",
            data: formData,
            success: function(data)
            {
                console.log(data);
                var msg = $('#msg');
                msg.html(data);
            }
        })
    });
</script>