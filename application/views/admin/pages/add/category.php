<div class="page-container">
    <div class="page-content">
        <form id="form" method="post">
            <div class="form-group">
                <label for="exampleSelect1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Type the category name here">
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

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>" + "ajax/addcategory",
            data: formData,
            success: function(data)
            {
                var msg = $('#msg');
                msg.html(data);
            }
        })
    });
</script>